<?php

declare(strict_types=1);

namespace labile\thief;

interface CommandStorage
{
    /**
     * Add a command with its resolvers.
     *
     * @param string $command
     * @param class-string<Command> ...$resolver
     * @return $this
     */
    public function add(string $command, string ...$resolver): static;

    /**
     * Retrieve all commands with their resolvers.
     *
     * @return array<string, array<class-string<Command>>>
     */
    public function all(): array;

    /**
     * Check if a command exists.
     *
     * @param string $command
     * @return bool
     */
    public function has(string $command): bool;

    /**
     * Remove a command.
     *
     * @param string $command
     * @return $this
     */
    public function remove(string $command): static;

    /**
     * Get a lazy-iterated list of commands that execute sequentially.
     *
     * @param string $command
     * @return iterable<Command>
     */
    public function pipe(string $command): iterable;
}
