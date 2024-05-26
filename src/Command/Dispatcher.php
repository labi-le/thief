<?php

declare(strict_types=1);

namespace labile\thief\Command;

use labile\thief\Types\Event;
use labile\thief\Types\Message;

interface Dispatcher
{
    /**
     * Realizes processing of commands and their execution at corresponding events
     * can throw exceptions, it's important to intercept them above,
     * so you don't get repeated requests from telegram
     * @param class-string<Event> $event
     * @param callable|class-string<Command> ...$resolver
     */
    public function on(string $event, ...$resolver): void;
}