<?php

declare(strict_types=1);

namespace labile\thief\tests\unit\Types;

use labile\thief\tests\unit\TestCase;

class BaseTypeTest extends TestCase
{
    public function testFromResponse()
    {
        $data = TestResponse::fromResponse(
            [
                'a' => 'a',
                'b' => 1,
                'c' => ['a' => 'a'],
                'd' => false,
                'e' => ['property' => 123]
            ]
        );
        $this->assertSame('a', $data->getA());
        $this->assertSame(1, $data->getB());
        $this->assertSame(['a' => 'a'], $data->getC());
        $this->assertSame(false, $data->getD());
        $this->assertSame(123, $data->getE()->getProperty());

        $newData = $data::fromResponse(
            [
                'a' => 'b',
                'b' => 2,
                'c' => ['b' => 'b'],
                'd' => true,
                'e' => ['property' => 456]
            ]
        );
        $this->assertNotEquals($data, $newData);

    }
}
