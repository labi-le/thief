<?php

declare(strict_types=1);

namespace labile\thief\examples;

use labile\thief\Command\Command;
use labile\thief\Response;
use labile\thief\Types\Result;

class Hello implements Command
{

    public function execute(): Response
    {
        var_dump(121212121122121);
        return Result::Ok;
    }

    public function pattern(): string
    {
        return 'hello';
    }

    public function description(): string
    {
        return 'Hello command';
    }

    public function getUsage(): string
    {
        return '/hello';
    }
}