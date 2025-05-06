<?php

namespace Random\Tests\Generator;

use PHPUnit\Framework\TestCase;
use Random\Generator\RandomStringGenerator;

class RandomStringGeneratorTest extends TestCase
{
    /**
     * @testdox Generates a random string of the correct length
     */
    public function testGeneratesCorrectLength()
    {
        $gen = new RandomStringGenerator(12);
        $result = $gen->generate();

        $this->assertEquals(12, strlen($result));
        $this->assertMatchesRegularExpression('/^[a-z0-9]+$/', $result);
    }
}
