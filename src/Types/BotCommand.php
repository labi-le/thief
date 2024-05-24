<?php
declare(strict_types=1);

namespace labile\thief\Types;

use labile\thief\Collection\CollectionItemInterface;

class BotCommand extends BaseType implements TypeInterface, CollectionItemInterface
{
    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $requiredParams = ['command', 'description'];

    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $map = [
        'command' => true,
        'description' => true,
    ];

    /**
     * Text of the command, 1-32 characters. Can contain only lowercase English letters, digits and underscores.
     *
     * @var string
     */
    protected string $command;

    /**
     * Description of the command, 3-256 characters.
     *
     * @var string
     */
    protected string $description;

    /**
     * @return string
     */
    public function getCommand(): string
    {
        return $this->command;
    }

    /**
     * @param string $command
     * @return void
     */
    public function setCommand(string $command): void
    {
        $this->command = $command;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return void
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
}
