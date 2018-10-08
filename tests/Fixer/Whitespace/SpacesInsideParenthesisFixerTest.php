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

namespace PhpCsFixer\Tests\Fixer\Whitespace;

use PhpCsFixer\Tests\Test\AbstractFixerTestCase;

/**
 * @author Marc Aubé
 *
 * @internal
 *
 * @covers \PhpCsFixer\Fixer\Whitespace\NoSpacesInsideParenthesisFixer
 */
final class SpacesInsideParenthesisFixerTest extends AbstractFixerTestCase
{
    /**
     * @param string      $expected
     * @param null|string $input
     *
     * @dataProvider provideFixCases
     */
    public function testFix($expected, $input = null)
    {
        $this->doTest($expected, $input);
    }

    public function provideFixCases()
    {
        return array(
            array(
                'private function bar(){}'
            ),
            array(
                '<?php foo( );'
            ),
            array(
                '<?php foo();'
            ),
             array(
                 '<?php
                 if ( true ) {
                     // if body
                 }',
                 '<?php
                 if (true) {
                     // if body
                 }',
             ),
            // array(
            //     '<?php
            //     if (     true   ) {
            //         // if body
            //     }',
            //     '<?php
            //     if (     true   ) {
            //         // if body
            //     }',
            // ),
            // array(
            //     '<?php
            //     function foo( $bar, $baz )
            //     {
            //         // function body
            //     }',
            //     '<?php
            //     function foo($bar, $baz)
            //     {
            //         // function body
            //     }',
            // ),
            // array(
            //     '<?php
            //     $foo->bar( $arg1, $arg2 );',
            //     '<?php
            //     $foo->bar($arg1, $arg2);',
            // ),
            // array(
            //     '<?php
            //     $var = array( $a, $b,$c );
            //     ',
            //     '<?php
            //     $var = array($a, $b,$c);
            //     ',
            // ),
            // array(
            //     '<?php
            //     $var = array( 1, 2, 3 );
            //     ',
            //     '<?php
            //     $var = array(1, 2, 3);
            //     ',
            // ),
            // array(
            //     '<?php
            //     $var = array( 1, 2, 3 );
            //     '
            // ),
            // // list call with trailing comma - need to leave alone
            // array(
            //     '<?php list( $path, $mode, ) = foo();',
            //     '<?php list($path, $mode, ) = foo();',
            // ),
            // array(
            //     '<?php list($path, $mode,) = foo();',
            // ),
            // array(
            // '<?php
            //     $a = $b->test(  // do not add space
            //         $e          // between `(` and `)`
            //                     // and this comment
            //     );'
            // ),
        );
    }
}
