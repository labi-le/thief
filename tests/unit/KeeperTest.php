<?php
declare(strict_types=1);

namespace labile\thief\tests\unit;

use labile\thief\Command\Command;
use labile\thief\Types\Message;

class KeeperTest extends TestCase
{
    public function testAll()
    {
        $keeper = $this->keeper();
        $this->assertCount(1, $keeper->all());

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
        $keeper->add(Message::class, TestCommand1::class, TestCommand2::class, TestCommand3::class);
        $this->assertTrue($keeper->has(Message::class, TestCommand1::class));

        foreach ($keeper->pipe(Message::class) as $item) {
            $this->assertInstanceOf(Command::class, $item);
            if ($item instanceof TestCommand1) {
                $this->assertNotEquals(0, $item->property->id);
            }
        }
    }

    public function testHas()
    {
        $keeper = $this->keeper();
        $this->assertTrue($keeper->has(Message::class, TestCommand1::class));
        $this->assertTrue($keeper->has(Message::class, TestCommand2::class));
    }

    public function testRemove()
    {
        $keeper = $this->keeper();
        $keeper->remove(Message::class, TestCommand1::class);
        $this->assertFalse($keeper->has(Message::class, TestCommand1::class));
        $this->assertTrue($keeper->has(Message::class, TestCommand2::class));
    }

    public function testPipe()
    {
        $keeper = $this->keeper();
        foreach ($keeper->pipe(Message::class) as $item) {
            $this->assertInstanceOf(Command::class, $item);
            if ($item instanceof TestCommand1) {
                $this->assertNotEquals(0, $item->property->id);
            }
        }

        foreach ($keeper->pipe(Message::class) as $item) {
            $this->assertInstanceOf(Command::class, $item);
            if ($item instanceof TestCommand1) {
                $this->assertNotEquals(0, $item->property->id);
            }
        }
    }
}
