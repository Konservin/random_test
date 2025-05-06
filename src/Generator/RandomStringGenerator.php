<?php

namespace Random\Generator;

use InvalidArgumentException;

class RandomStringGenerator
{
    private int $length;
    public const MAX_LENGTH = 32;

    public function __construct(int $length = 14)
    {
        if ($length < 1 || $length > self::MAX_LENGTH) {
            throw new InvalidArgumentException("String Length must be between 1 and " . self::MAX_LENGTH . ".");
        }
        $this->length = $length;
    }

    public function generate(): string
    {
        $characters = implode('', array_merge(range('a', 'z'), range('0', '9')));
        $result = '';
        $maxIndex = strlen($characters) - 1;

        for ($i = 0; $i < $this->length; $i++) {
            $result .= $characters[random_int(0, $maxIndex)];
        }

        return $result;
    }
}
