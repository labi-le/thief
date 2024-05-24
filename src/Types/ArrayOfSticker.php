<?php
declare(strict_types=1);

namespace labile\thief\Types;

abstract class ArrayOfSticker
{
    /**
     * @param array $data
     * @return Sticker[]
     */
    public static function fromResponse(array $data): array
    {
        $arrayOfStickers = [];
        foreach ($data as $sticker) {
            $arrayOfStickers[] = Sticker::fromResponse($sticker);
        }

        return $arrayOfStickers;
    }
}
