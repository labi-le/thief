<?php

namespace labile\thief\tests\unit;

use labile\thief\Command;
use labile\thief\Response;

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
        // TODO: Implement execute() method.
    }
}