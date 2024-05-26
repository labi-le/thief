<?php
declare(strict_types=1);

namespace labile\thief\tests\unit;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\HttpFactory;
use labile\thief\Command\Keeper;
use labile\thief\Command\Storage;
use labile\thief\Juggler;
use labile\thief\Types\Message;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;
use Psr\Container\ContainerInterface;
use Yiisoft\Di\Container;
use Yiisoft\Di\ContainerConfig;

class TestCase extends \PHPUnit\Framework\TestCase
{
    public function container(): ContainerInterface
    {
        return new Container(ContainerConfig::create());
    }

    public function keeper(): Storage
    {
        $keeper = new Keeper($this->container());
        $keeper->add(Message::class, TestCommand1::class, TestCommand2::class, TestCommand3::class);
        $keeper->add(Message::class, TestCommand1::class, TestCommand2::class, TestCommand3::class);

        return $keeper;
    }

    public function juggler(): Juggler
    {
        $logger = new Logger('test');
        $logger->pushHandler(new StreamHandler('php://stdout', Level::Debug));

        return new Juggler(
            getenv('THIEF_BOT_TOKEN_TEST') ?: '123456:ABC-DEF1234ghIkl-zyx57W2v1u123ew11',
            username: 'test',
            keeper: $this->keeper(),
            httpClient: new Client(),
            requestFactory: new HttpFactory(),
            streamFactory: new HttpFactory(),
            logger: $logger
        );
    }
}