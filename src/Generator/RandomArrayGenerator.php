<?php

namespace Random\Generator;

use InvalidArgumentException;

class RandomArrayGenerator
{
    private RandomStringGenerator $stringGenerator;
    private int $count;
    public const MAX_COUNT = 16;

    public function __construct(RandomStringGenerator $stringGenerator, int $count = 3)
    {
        $this->stringGenerator = $stringGenerator;
        if ($count < 1 || $count > self::MAX_COUNT) {
            throw new InvalidArgumentException("Array Size must be between 1 and " . self::MAX_COUNT . ".");
        }
        $this->count = $count;
    }

    public function generate(): array
    {
        $result = [];
        for ($i = 0; $i < $this->count; $i++) {
            $result[] = $this->stringGenerator->generate();
        }

        return $result;
    }
}
