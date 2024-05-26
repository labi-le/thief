<?php

declare(strict_types=1);

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\HttpFactory;
use labile\thief\Command\EventDispatcher;
use labile\thief\Command\Keeper;
use labile\thief\Configurator;
use labile\thief\examples\Goodbye;
use labile\thief\examples\Hello;
use labile\thief\Juggler;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;
use Yiisoft\Di\Container;
use Yiisoft\Di\ContainerConfig;

require __DIR__ . '/../vendor/autoload.php';


$di = new Container(ContainerConfig::create());

$logger = new Logger('test');
$logger->pushHandler(new StreamHandler('php://stdout', Level::Debug));

$keeper = new Keeper();

$bot = new Juggler(
    '7091231001:AAFPtAypDBvzKEBuO8tz6lhKL_rCA4egK-s',
    'test',
    new Configurator(
        keeper: $keeper,
        httpClient: new Client(),
        requestFactory: new HttpFactory(),
        streamFactory: new HttpFactory(),
        eventDispatcher: new EventDispatcher($keeper, $di),
        logger: $logger,
        debug: true
    )
);


$keeper->add(
    labile\thief\Types\Message::class,
    Hello::class,
    Goodbye::class
);

//$bot->setWebhook('https://local.labile.cc/');

$bot->juggle();