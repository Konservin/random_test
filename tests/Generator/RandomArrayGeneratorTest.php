<?php

namespace Random\Tests\Generator;

use PHPUnit\Framework\TestCase;
use Random\Generator\RandomStringGenerator;
use Random\Generator\RandomArrayGenerator;

class RandomArrayGeneratorTest extends TestCase
{
    /**
     * @testdox Generates an array random strings of the correct size
     */
    public function testGeneratesArrayOfStrings()
    {
        $stringGen = new RandomStringGenerator(10);
        $arrayGen = new RandomArrayGenerator($stringGen, 5);

        $result = $arrayGen->generate();

        $this->assertCount(5, $result);
        foreach ($result as $string) {
            $this->assertEquals(10, strlen($string));
            $this->assertMatchesRegularExpression('/^[a-z0-9]+$/', $string);
        }
    }
}
