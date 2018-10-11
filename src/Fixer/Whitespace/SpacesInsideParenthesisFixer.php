<?php

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace PhpCsFixer\Fixer\Whitespace;

use PhpCsFixer\AbstractFixer;
use PhpCsFixer\FixerDefinition\CodeSample;
use PhpCsFixer\FixerDefinition\FixerDefinition;
use PhpCsFixer\Tokenizer\Tokens;
use PhpCsFixer\Tokenizer\Token;

/**
 * Fixer for rules defined in PSR2 ¶4.3, ¶4.6, ¶5.
 *
 * @author Marc Aubé
 * @author Dariusz Rumiński <dariusz.ruminski@gmail.com>
 */
final class SpacesInsideParenthesisFixer extends AbstractFixer
{
    /**
     * {@inheritdoc}
     */
    public function getDefinition()
    {
        return new FixerDefinition(
            'There MUST be a space after the opening parenthesis of a non-empty statement. There MUST be a space before the closing parenthesis of a non-empty statement.',
            [
                new CodeSample("<?php\nif (\$a) {\n    foo();\n}\n"),
                new CodeSample("<?php\nfunction foo( \$bar, \$baz )\n{\n}\n"),
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getPriority()
    {
        // must run before FunctionToConstantFixer
        return 2;
    }

    /**
     * {@inheritdoc}
     */
    public function isCandidate(Tokens $tokens)
    {
        return $tokens->isTokenKindFound('(');
    }

    /**
     * {@inheritdoc}
     */
    protected function applyFix(\SplFileInfo $file, Tokens $tokens)
    {
        for ($index = $tokens->count() - 1; $index >= 0; --$index) {
            if ( $tokens[$index]->equals( ')' ) ) {
                $this->fixSpacing( $index, $tokens );
            }
        }
    }
        /**
     * Method to fix spacing in array declaration.
     *
     * @param int    $index
     * @param Tokens $tokens
     */
    private function fixSpacing($index, Tokens $tokens)
    {
        // insert space after opening `(`
        $startIndex = $tokens->findBlockStart(Tokens::BLOCK_TYPE_PARENTHESIS_BRACE, $index);

        if ( $startIndex === $index - 1 ){
            return;
        }
        if (!$tokens[$tokens->getPrevMeaningfulToken($index)]->equals(',')) {
            $tokens->ensureWhitespaceAtIndex($index-1,0,' ');
        }


        // insert space before closing `)` if it is not `list($a, $b, )` case
        if (!$tokens[$tokens->getNextNonWhitespace($startIndex)]->isComment()) {
            $tokens->ensureWhitespaceAtIndex($startIndex+1,0,' ');
        }
    }

}
