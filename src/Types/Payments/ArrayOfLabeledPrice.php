<?php
declare(strict_types=1);

namespace labile\thief\Types\Payments;

abstract class ArrayOfLabeledPrice
{
    /**
     * @param array $data
     * @return LabeledPrice[]
     */
    public static function fromResponse(array $data): array
    {
        $arrayOfLabeledPrice = [];
        foreach ($data as $labeledPrice) {
            $arrayOfLabeledPrice[] = LabeledPrice::fromResponse($labeledPrice);
        }

        return $arrayOfLabeledPrice;
    }
}
