<?php

namespace labile\thief\tests\unit;

use labile\thief\Command;
use labile\thief\Keeper;
use PHPUnit\Framework\TestCase;
use Yiisoft\Di\Container;
use Yiisoft\Di\ContainerConfig;

class KeeperTest extends TestCase
{

    public function testAll()
    {

    }

    public function testAdd()
    {

    }

    public function testHas()
    {

    }

    public function testRemove()
    {

    }

    public function testPipe()
    {
        $container = new Container(ContainerConfig::create());
        $keeper = new Keeper($container);

        $keeper->add("/start", TestCommand1::class, TestCommand2::class, TestCommand3::class);
        $keeper->add("/test", TestCommand2::class, TestCommand3::class, TestCommand1::class);

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
