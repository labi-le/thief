<?php
declare(strict_types=1);

namespace labile\thief\Types;

use labile\thief\Collection\Collection;

final class ArrayOfBotCommand extends Collection implements TypeInterface
{
    public static function fromResponse(array $data): static
    {
        $arrayOfBotCommand = new self();
        foreach ($data as $botCommand) {
            $arrayOfBotCommand->addItem(BotCommand::fromResponse($botCommand));
        }

        return $arrayOfBotCommand;
    }
}
