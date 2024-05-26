<?php

declare(strict_types=1);

namespace labile\thief\Command;

use labile\thief\Types\Event;

/**
 * @template TEvent of Event
 * @template TCommand of Command
 */
interface Storage
{
    /**
     * Add a command with its resolvers
     *
     * @param string $filter
     * @param class-string<TCommand> ...$command
     * @return $this
     */
    public function add(string $filter, string ...$command): static;

    /**
     * Retrieve all commands with their resolvers
     *
     * @return array<string, array<class-string<TCommand>>>
     */
    public function all(): array;

    /**
     * Check if a command exists on event
     *
     * @param class-string<TCommand> $command
     * @return bool
     */
    public function has(string $command): bool;

    /**
     * Remove a command.
     *
     * @param class-string<TCommand> ...$command
     * @return static
     */
    public function remove(string ...$command): static;

    /**
     * Get a lazy-iterated list of commands that execute sequentially
     *
     * @return iterable<TCommand>
     */
    public function pipe(): iterable;
}
