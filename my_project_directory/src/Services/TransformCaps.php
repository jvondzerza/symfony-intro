<?php

namespace App\Services;

class TransformCaps implements TransformInterface
{
    public function transform(string $string): string
    {
        for ($i = 0, $length = strlen($string); $i < $length; $i += 2) {
            $string[$i] = strtoupper($string[$i]);
        }
        return $string;
    }
}