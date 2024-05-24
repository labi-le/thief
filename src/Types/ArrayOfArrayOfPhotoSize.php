<?php
declare(strict_types=1);

namespace labile\thief\Types;

abstract class ArrayOfArrayOfPhotoSize
{
    /**
     * @param array $data
     * @return PhotoSize[][]
     */
    public static function fromResponse(array $data): array
    {
        return array_map(function ($arrayOfPhotoSize) {
            return ArrayOfPhotoSize::fromResponse($arrayOfPhotoSize);
        }, $data);
    }
}
