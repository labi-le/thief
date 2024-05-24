<?php

declare(strict_types=1);

namespace labile\thief\tests\unit\Types;

use labile\thief\Types\BaseType;

class TestResponse extends BaseType
{
    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $requiredParams = ['a', 'b', 'c', 'd', 'e'];

    protected static array $map = [
        'a' => true,
        'b' => true,
        'c' => true,
        'd' => true,
        'e' => TestCompositeReference::class
    ];

    protected string $a;
    protected int $b;
    protected array $c;
    protected bool $d;
    protected TestCompositeReference $e;

    public function setA(string $a): void
    {
        $this->a = $a;
    }

    public function setB(int $b): void
    {
        $this->b = $b;
    }

    public function setC(array $c): void
    {
        $this->c = $c;
    }

    public function setD(bool $d): void
    {
        $this->d = $d;
    }

    public function setE(TestCompositeReference $e): void
    {
        $this->e = $e;
    }

    public function getA(): string
    {
        return $this->a;
    }

    public function getB(): int
    {
        return $this->b;
    }

    public function getC(): array
    {
        return $this->c;
    }

    public function getD(): bool
    {
        return $this->d;
    }

    public function getE(): TestCompositeReference
    {
        return $this->e;
    }
}