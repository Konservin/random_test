<?php

namespace Random\Tests\Encoder;

use PHPUnit\Framework\TestCase;
use Random\Encoder\Rot13Encoder;

class Rot13EncoderTest extends TestCase
{
    private const TEST_STRING = 'teststring1314';

    public function testEncodesString()
    {
        $encoder = new Rot13Encoder();
        $original = self::TEST_STRING;
        $encoded = $encoder->encode($original);
        $decoded = $encoder->encode($encoded);

        $this->assertEquals($original, $decoded);
    }

    public function testEncodesArray()
    {
        $encoder = new Rot13Encoder();
        $input = ['hello', 'world'];
        $expected = ['uryyb', 'jbeyq'];

        $this->assertEquals($expected, $encoder->encodeArray($input));
    }
}
