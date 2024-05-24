<?php
declare(strict_types=1);

namespace labile\thief\Types;

abstract class ArrayOfChatMemberEntity
{
    /**
     * @param array $data
     * @return ChatMember[]
     */
    public static function fromResponse(array $data): array
    {
        $arrayOfChatMemberEntity = [];
        foreach ($data as $chatMemberEntity) {
            $arrayOfChatMemberEntity[] = ChatMember::fromResponse($chatMemberEntity);
        }

        return $arrayOfChatMemberEntity;
    }
}
