<?php
declare(strict_types=1);

namespace labile\thief\Types;

abstract class ArrayOfUpdates
{
    /**
     * @param array $data
     * @return Update[]
     */
    public static function fromResponse(array $data): array
    {
        $arrayOfUpdates = [];
        foreach ($data as $update) {
            $arrayOfUpdates[] = Update::fromResponse($update);
        }

        return $arrayOfUpdates;
    }
}
