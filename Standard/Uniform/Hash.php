<?php


namespace UWebPro\WordPress\Uniform;


interface Hash
{
    public function __construct(string $salt, int $length = 0);

    public function encode(int $id): string;

    public function decode(string $hashid): int;

    public function str_rand(): string;
}