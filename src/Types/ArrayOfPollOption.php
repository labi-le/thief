<?php
declare(strict_types=1);

namespace labile\thief\Types;

abstract class ArrayOfPollOption
{
    /**
     * @param array $data
     * @return PollOption[]
     */
    public static function fromResponse(array $data): array
    {
        $arrayOfPollOption = [];
        foreach ($data as $pollOptionItem) {
            $arrayOfPollOption[] = PollOption::fromResponse($pollOptionItem);
        }

        return $arrayOfPollOption;
    }
}
