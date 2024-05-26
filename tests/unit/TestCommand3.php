<?php
declare(strict_types=1);

namespace labile\thief\tests\unit;

use labile\thief\Command\Command;
use labile\thief\Response;
use labile\thief\Types\Result;

class TestCommand3 implements Command
{

    public function execute(): Response
    {
        return Result::Ok;
    }
}