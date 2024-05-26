<?php

declare(strict_types=1);

namespace labile\thief;

use labile\thief\Command\Dispatcher;
use labile\thief\Command\Storage;
use labile\thief\Update\Input;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

readonly class Configurator
{
    /**
     * @param Storage $keeper is where we keep our commands
     * @param ClientInterface $httpClient
     * @param RequestFactoryInterface $requestFactory
     * @param StreamFactoryInterface $streamFactory
     * @param Dispatcher $eventDispatcher how we should handle events
     * @param LoggerInterface $logger
     * @param StreamInterface $input where we parse incoming data from
     * @param Decoder $decoder how we parse incoming data
     * @param bool $debug show additional logs
     */
    public function __construct(
        public Storage                 $keeper,
        public ClientInterface         $httpClient,
        public RequestFactoryInterface $requestFactory,
        public StreamFactoryInterface  $streamFactory,
        public Dispatcher              $eventDispatcher,
        public LoggerInterface         $logger = new NullLogger(),
        public StreamInterface         $input = new Input(),
        public Decoder                 $decoder = new StdJsonDecoder(),
        public bool                    $debug = false,
    )
    {

    }
}