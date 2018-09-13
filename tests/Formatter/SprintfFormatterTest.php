<?php
declare(strict_types = 1);

namespace Budgegeria\IntlFormat\Tests\Formatter;

use Budgegeria\IntlFormat\Formatter\SprintfFormatter;
use PHPUnit\Framework\TestCase;

class SprintfFormatterTest extends TestCase
{
    /**
     * @param string $typeSpecifier
     * @dataProvider provideTypeSpecifier
     */
    public function testHas($typeSpecifier)
    {
        $formatter = new SprintfFormatter();

        self::assertTrue($formatter->has($typeSpecifier));
    }

    /** @dataProvider provideTypeSpecifier */
    public function testFormat($typeSpecifier, $value, $expected)
    {
        $formatter = new SprintfFormatter();

        self::assertEquals($expected, $formatter->formatValue($typeSpecifier, $value));
    }

    public function testHasIsFalse()
    {
        $formatter = new SprintfFormatter();

        self::assertFalse($formatter->has('int'));
    }

    /**
     * @return array
     */
    public function provideTypeSpecifier()
    {
        return [
            ['b', 11, '1011'],
            ['08b', 11, '00001011'],
            ['0--8b', 11, '10110000'],
            ['\'+--8b', 11, '1011++++'],
            ['c', 32, ' '],
            ['d', -12, '-12'],
            ['e', '1.2', '1.200000e+0'],
            ['E', '1.2', '1.200000E+0'],
            ["+'+12.4f", 1.2, '++++++1.2000'],
            ["+'+12.4F", 1.2, '++++++1.2000'],
            ["+'+12.4g", 1.2, '+++++++++1.2' ],
            ["+'+12.4G", 1.2, '+++++++++1.2' ],
            ["+'+24.4g", 1.2, '+++++++++++++++++++++1.2' ],
            ["+'+24.4G", 1.2, '+++++++++++++++++++++1.2' ],
            ["o", 12, '14'],
            ['s', 'test', 'test'],
            ["u", -123, '18446744073709551493'],
            ["x", 123, '7b'],
            ['X', 123, '7B'],
        ];
    }
}
