<?php

namespace Random\Encoder;

class Rot13Encoder
{
    public function encode(string $input): string
    {
        return str_rot13($input);
    }

    public function encodeArray(array $input): array
    {
        return array_map([$this, 'encode'], $input);
    }
}
