<?php
declare(strict_types=1);

namespace labile\thief\Types;

abstract class ArrayOfMessages
{
    /**
     * @param array $data
     * @return Message[]
     */
    public static function fromResponse(array $data): array
    {
        $arrayOfMessages = [];
        foreach ($data as $message) {
            $arrayOfMessages[] = Message::fromResponse($message);
        }

        return $arrayOfMessages;
    }
}
