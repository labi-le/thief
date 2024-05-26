<?php
declare(strict_types=1);

namespace labile\thief\tests\unit;

use labile\thief\Command\Command;
use labile\thief\Response;
use labile\thief\Types\Result;

class TestCommand1 implements Command
{
    public function __construct(
        public TestPropertyCommand1 $property,
        public TestPropertyCommand2 $property2,
        public TestPropertyCommand3 $property3,
    )
    {
    }

    public function execute(): Response
    {
        return Result::Ok;
    }
}