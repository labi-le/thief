<?php

namespace labile\thief\tests\unit;

use labile\thief\CommandStorage;
use labile\thief\Keeper;
use Psr\Container\ContainerInterface;
use Yiisoft\Di\Container;
use Yiisoft\Di\ContainerConfig;

class TestCase extends \PHPUnit\Framework\TestCase
{
    public function container(): ContainerInterface
    {
        return new Container(ContainerConfig::create());
    }

    public function keeper(): CommandStorage
    {
        $keeper = new Keeper($this->container());
        $keeper->add("/start", TestCommand1::class, TestCommand2::class, TestCommand3::class);
        $keeper->add("/test", TestCommand1::class, TestCommand2::class, TestCommand3::class);

        return clone $keeper;
    }
}