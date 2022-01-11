<?php

namespace App\Services;

class TransformDash implements TransformInterface
{
    public function transform(string $string): string
    {
        return str_replace(' ', '-', $string);
    }
}