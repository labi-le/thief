<?php

declare(strict_types=1);

namespace labile\thief;

use Psr\Container\ContainerInterface;

class Keeper implements CommandStorage
{

    public function __construct(
        protected ContainerInterface $container
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

    public function add(string $command, string ...$resolver): static
    {
        $this->commands[$command] = array_merge($this->commands[$command] ?? [], $resolver);
        return $this;
    }

    public function has(string $command): bool
    {
        return isset($this->commands[$command]);
    }

    public function remove(string $command): static
    {
        unset($this->commands[$command]);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function pipe(string $command): iterable
    {
        /**
         * MUST return Command instance with properties
         */
        foreach ($this->commands[$command] as $command) {
            yield $this->container->get($command);
        }
    }
}