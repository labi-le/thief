<?php

declare(strict_types=1);

namespace labile\thief;

use InvalidArgumentException;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

class Juggler implements WebhookManipulator
{
    protected readonly string $token;
    protected readonly int $botID;

    protected const ENDPOINT = 'https://api.telegram.org/';

    public function __construct(
        string                                     $token,
        protected readonly string                  $username,
        protected readonly CommandStorage          $keeper,
        protected readonly ClientInterface         $httpClient,
        protected readonly RequestFactoryInterface $requestFactory,
        protected readonly StreamFactoryInterface  $streamFactory,
        protected readonly LoggerInterface         $logger = new NullLogger(),

    )
    {
        preg_match('/(\d+):[\w\-]+/', $token, $matches);
        if (!isset($matches[1])) {
            throw new InvalidArgumentException('Invalid token');
        }
        $this->botID = (int)$matches[1];
        $this->token = $token;
    }


    public function setWebhook(string $url, array $options = []): bool
    {
        $data = array_merge(['url' => $url], $options);
        $response = $this->request(sprintf('%sbot%s/setWebhook', self::ENDPOINT, $this->token), $data);

        $this->logger->info($response->getBody()->getContents());

        return $response->getStatusCode() === 200;
    }

    public function deleteWebhook(bool $dropPendingUpdates = false): bool
    {
        $data = ['drop_pending_updates' => $dropPendingUpdates];
        $response = $this->request(sprintf('%sbot%s/deleteWebhook', self::ENDPOINT, $this->token), $data);

        return $response->getStatusCode() === 200;
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function request(string $url, array $data = [], string $method = 'POST'): ResponseInterface
    {
        $body = $this->streamFactory->createStream(http_build_query($data));

        $request = $this->requestFactory->createRequest($method, $url)
            ->withHeader('Content-Type', 'application/x-www-form-urlencoded')
            ->withHeader('User-Agent', 'https://github.com/labi-le/thief')
            ->withHeader('Authorization', 'Bearer ' . $this->token)
            ->withHeader('Accept', 'application/json')
            ->withHeader('Content-Length', (int)$body->getSize())
            ->withHeader('X-Telegram-Bot-Api-Secret-Token', $this->token)
            ->withBody($body);

        $this->logger->debug("Sending $method request to {$request->getUri()}", [
            'headers' => $request->getHeaders(),
            'body' => $body->getContents(),
        ]);

        $response = $this->httpClient->sendRequest($request);

        $this->logger->debug("Received with {$response->getStatusCode()}", [
            'headers' => $response->getHeaders(),
            'body' => $response->getBody()->getContents(),
        ]);

        if ($response->getStatusCode() !== 200) {
            $this->logger->error("Request failed with {$response->getStatusCode()}", [
                'headers' => $response->getHeaders(),
                'body' => $response->getBody()->getContents(),
            ]);
        }

        $response->getBody()->rewind();
        return $response;
    }

    public function webhookInfo(): array
    {
        $response = $this->request(sprintf('%sbot%s/getWebhookInfo', self::ENDPOINT, $this->token));

        return json_decode($response->getBody()->getContents(), true);
    }
}