<?php
declare(strict_types=1);

namespace labile\thief\Collection;

interface CollectionItemInterface
{
    /**
     * @param bool $inner
     * @return array|string
     */
    public function toJson(bool $inner = false): array|string;
}
