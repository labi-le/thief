<?php

declare(strict_types=1);

namespace labile\thief\Command;

use labile\thief\Types\Event;
use labile\thief\Types\Message;
use labile\thief\Types\Result;
use labile\thief\Types\Update;
use Psr\Container\ContainerInterface;

/**
 */
readonly class EventDispatcher implements Dispatcher
{
    /**
     * @param Storage $storage
     * @param ContainerInterface $container
     */
    public function __construct(
        public Storage               $storage,
        protected ContainerInterface $container

    )
    {
    }

    /**
     * @inheritDoc
     */
    public function on(string $event, ...$resolver): void
    {
//            if (!$this->compare($event, $filter)) {
//                continue;
//            }
//            /**
//             * @var Command $command
//             */
//            $command = $this->container->get($recipe);
//            $result = $command->execute();
//
//            /** @noinspection PhpConditionAlreadyCheckedInspection */
//            if ($result instanceof Result && !$result->isOk()) {
//                break;
//            }
    }

    protected function compare(Event $event, int|string $filter): bool
    {
        return true;
    }
}