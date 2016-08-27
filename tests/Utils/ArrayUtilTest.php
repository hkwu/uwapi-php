<?php

namespace Tests\Utils;

use Tests\APITestCase;
use UWaterlooAPI\Utils\ArrayUtil;

class ArrayUtilTest extends APITestCase
{
    public function testGetVal()
    {
        $mock = [
            'layer' => [
                'two' => 23,
                'three' => '123',
                '4' => [
                    null,
                    123,
                    'three',
                ],
            ],
        ];

        $this->assertEquals('123', ArrayUtil::getVal($mock, ['layer', 'three']));
        $this->assertNull(ArrayUtil::getVal($mock, ['layer', '4', 0]));
        $this->assertEquals(123, ArrayUtil::getVal($mock, ['layer', '4', 1]));
        $this->assertNull(ArrayUtil::getVal($mock, ['nonExistent']));
    }
}
