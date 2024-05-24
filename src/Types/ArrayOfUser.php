<?php
declare(strict_types=1);

namespace labile\thief\Types;

abstract class ArrayOfUser
{
    /**
     * @param array $data
     * @return User[]
     */
    public static function fromResponse(array $data): array
    {
        $arrayOfUsers = [];
        foreach ($data as $user) {
            $arrayOfUsers[] = User::fromResponse($user);
        }

        return $arrayOfUsers;
    }
}
