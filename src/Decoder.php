<?php

declare(strict_types=1);

namespace labile\thief;

interface Decoder
{
    public function asArray(string $content): array;

    public function asObject(string $content): object;
}