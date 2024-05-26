<?php

declare(strict_types=1);

namespace labile\thief\Types;

use labile\thief\Response;

enum Result implements Response
{
    case Ok;
    case Error;

    public function isOk(): bool
    {
        return $this === self::Ok;
    }

    public function isError(): bool
    {
        return $this === self::Error;
    }
}