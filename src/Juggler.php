<?php

declare(strict_types=1);

namespace labile\thief;

use InvalidArgumentException;
use Psr\Http\Client\ClientInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

class Juggler
{
    protected readonly string $apiKey;
    protected readonly string $botUsername;
    protected readonly int $botID;

    protected ClientInterface $client;
    protected LoggerInterface $logger;

    public readonly CommandStorage $commands;

    public function __construct(
        string $apiKey,
        string $botUsername,
        ClientInterface $client,
        CommandStorage $keeper,
        LoggerInterface $logger = new NullLogger(),
    )
    {
        preg_match('/(\d+):[\w\-]+/', $apiKey, $matches);
        if (!isset($matches[1])) {
            throw new InvalidArgumentException('Invalid Api Key');
        }
        $this->botID = (int)$matches[1];
        $this->apiKey = $apiKey;
        $this->botUsername = $botUsername;

        $this->client = $client;
        $this->commands = $keeper;
        $this->logger = $logger;
    }


}