<?php
declare(strict_types=1);

namespace labile\thief\Types;

abstract class ArrayOfPhotoSize
{
    /**
     * @param array $data
     * @return PhotoSize[]
     */
    public static function fromResponse(array $data): array
    {
        $arrayOfPhotoSize = [];
        foreach ($data as $photoSizeItem) {
            $arrayOfPhotoSize[] = PhotoSize::fromResponse($photoSizeItem);
        }

        return $arrayOfPhotoSize;
    }
}
