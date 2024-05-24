<?php

declare(strict_types=1);

namespace labile\thief\Types;

abstract class ArrayOfMessageEntity
{
    /**
     * @param array $data
     * @return MessageEntity[]
     */
    public static function fromResponse(array $data): array
    {
        $arrayOfMessageEntity = [];
        foreach ($data as $messageEntity) {
            $arrayOfMessageEntity[] = MessageEntity::fromResponse($messageEntity);
        }

        return $arrayOfMessageEntity;
    }
}
