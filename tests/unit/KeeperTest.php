<?php

namespace labile\thief\tests\unit;

use labile\thief\Command;

class KeeperTest extends TestCase
{
    public function testAll()
    {
        $keeper = $this->keeper();
        $this->assertCount(2, $keeper->all());

        foreach ($keeper->all() as $command) {
            $this->assertIsArray($command);
            foreach ($command as $item) {
                $this->assertIsString($item);
            }
        }
    }

    public function testAdd()
    {
        $keeper = $this->keeper();
        $keeper->add('/add', TestCommand1::class, TestCommand2::class, TestCommand3::class);
        $this->assertTrue($keeper->has('/add'));

        foreach ($keeper->pipe('/add') as $item) {
            $this->assertInstanceOf(Command::class, $item);
            if ($item instanceof TestCommand1) {
                $this->assertNotEquals(0, $item->property->id);
            }
        }
    }

    public function testHas()
    {
        $keeper = $this->keeper();
        $this->assertTrue($keeper->has('/start'));
        $this->assertTrue($keeper->has('/test'));
    }

    public function testRemove()
    {
        $keeper = $this->keeper();
        $keeper->remove('/test');
        $this->assertFalse($keeper->has('/test'));
        $this->assertTrue($keeper->has('/start'));
    }

    public function testPipe()
    {
        $keeper = $this->keeper();
        foreach ($keeper->pipe('/start') as $item) {
            $this->assertInstanceOf(Command::class, $item);
            if ($item instanceof TestCommand1) {
                $this->assertNotEquals(0, $item->property->id);
            }
        }

        foreach ($keeper->pipe('/test') as $item) {
            $this->assertInstanceOf(Command::class, $item);
            if ($item instanceof TestCommand1) {
                $this->assertNotEquals(0, $item->property->id);
            }
        }
    }
}
