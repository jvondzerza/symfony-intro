<?php

namespace App\Services;

interface TransformInterface
{
    public function transform(string $string): string;
}