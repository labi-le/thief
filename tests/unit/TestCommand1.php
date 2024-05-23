<?php

namespace labile\thief\tests\unit;

use labile\thief\Command;

class TestCommand1 implements Command
{
    public function __construct(
        public TestPropertyCommand1 $property,
        public TestPropertyCommand2 $property2,
        public TestPropertyCommand3 $property3,
    )
    {
    }

    public function execute()
    {
        // TODO: Implement execute() method.
    }
}