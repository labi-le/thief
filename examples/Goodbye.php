<?php

declare(strict_types=1);

namespace labile\thief\examples;

use labile\thief\Command\Command;
use labile\thief\Response;
use labile\thief\Types\Result;

class Goodbye implements Command
{

    public function execute(): Response
    {
        var_dump(121212121122121);
        return Result::Ok;
    }

    public function pattern(): string
    {
        return 'goodbye';
    }

    public function description(): string
    {
        return 'Goodbye command';
    }

    public function getUsage(): string
    {
        return '/goodbye';
    }
}