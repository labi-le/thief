<?php

declare(strict_types=1);

namespace labile\thief;

use InvalidArgumentException;
use labile\thief\Command\Storage;
use labile\thief\Types\Update;
use labile\thief\Update\Input;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

class Juggler implements WebhookManipulator
{
    protected readonly string $token;
    protected readonly int $botID;

    protected const ENDPOINT = 'https://api.telegram.org/';

    public function __construct(
        string                          $token,
        protected readonly string       $username,
        protected readonly Configurator $tools,
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

        $this->tools->logger->info($response->getBody()->getContents());

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
        $body = $this->tools->streamFactory->createStream(http_build_query($data));

        $request = $this->tools->requestFactory->createRequest($method, $url)
            ->withHeader('Content-Type', 'application/x-www-form-urlencoded')
            ->withHeader('User-Agent', 'https://github.com/labi-le/thief')
            ->withHeader('Authorization', 'Bearer ' . $this->token)
            ->withHeader('Accept', 'application/json')
            ->withHeader('Content-Length', (int)$body->getSize())
            ->withHeader('X-Telegram-Bot-Api-Secret-Token', $this->token)
            ->withBody($body);

        $this->tools->logger->debug("Sending $method request to {$request->getUri()}", [
            'headers' => $request->getHeaders(),
            'body' => $body->getContents(),
        ]);

        $response = $this->tools->httpClient->sendRequest($request);

        $this->tools->logger->debug("Received with {$response->getStatusCode()}", [
            'headers' => $response->getHeaders(),
            'body' => $response->getBody()->getContents(),
        ]);

        if ($response->getStatusCode() !== 200) {
            $this->tools->logger->error("Request failed with {$response->getStatusCode()}", [
                'headers' => $response->getHeaders(),
                'body' => $response->getBody()->getContents(),
            ]);
        }

        $response->getBody()->rewind();
        return $response;
    }

    public function webhookInfo(): object
    {
        $response = $this->request(sprintf('%sbot%s/getWebhookInfo', self::ENDPOINT, $this->token));

        return $this->tools->decoder->asObject($response->getBody()->getContents());
    }

    public function juggle(): void
    {
        $content = $this->tools->input->getContents();
        $data = $this->tools->decoder->asArray($content);
        $this->tools->logger->debug($content);

        // catch the name of the event
        $event = (string)key(array_slice($data, 1, 1));
        if (!$event) {
            return;
        }

        $this->tools->eventDispatcher->on(Update::fromResponse($data)->getEvent($event)::class);
    }

}