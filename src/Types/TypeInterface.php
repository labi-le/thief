<?php

declare(strict_types=1);

namespace labile\thief\Types;

interface TypeInterface
{
    /**
     * @param array $data
     * @return static
     */
    public static function fromResponse(array $data): static;
}
