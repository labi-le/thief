<?php

declare(strict_types=1);

namespace labile\thief\Command;

use Psr\Container\ContainerInterface;

class Keeper implements Storage
{
    public function __construct(
    )
    {
    }

    /**
     * @var array<string, array<class-string<Command>>>
     */
    protected array $commands = [];

    /**
     * @inheritDoc
     */
    public function all(): array
    {
        return $this->commands;
    }

    /**
     * @inheritDoc
     */
    public function add(string $filter, string ...$command): static
    {
        if (!isset($this->commands[$filter])) {
            $this->commands[$filter] = [];
        }
        $this->commands[$filter] = array_merge($this->commands[$filter], $command);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function has(string $command): bool
    {
        return isset($this->commands[$command]);
    }

    /**
     * @inheritDoc
     */
    public function remove(string ...$command): static
    {
        foreach ($command as $cmd) {
            unset($this->commands[$cmd]);
        }
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function pipe(): iterable
    {
        foreach ($this->commands as $command) {
            foreach ($command as $subcommand) {
                yield $subcommand;
            }
        }
    }
}