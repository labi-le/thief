<?php

declare(strict_types=1);

namespace labile\thief;

class StdJsonDecoder implements Decoder
{
    public function asArray(string $content): array
    {
        return (array)json_decode($content, true);
    }

    public function asObject(string $content): object
    {
        return (object)json_decode($content, false);
    }
}