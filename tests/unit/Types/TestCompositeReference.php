<?php

declare(strict_types=1);

namespace labile\thief\tests\unit\Types;

use labile\thief\Types\BaseType;

class TestCompositeReference extends BaseType {
    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $requiredParams = ['property'];

    protected static array $map = ['property' => true];

    protected int $property;

    public function setProperty(int $property): void
    {
        $this->property = $property;
    }

    public function getProperty(): int
    {
        return $this->property;
    }

}