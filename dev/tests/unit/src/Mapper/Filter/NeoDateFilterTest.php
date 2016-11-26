<?php
namespace Picamator\NeoWsClient\Tests\Unit\Mapper\FIlter;

use Picamator\NeoWsClient\Mapper\Filter\NeoDateFilter;
use Picamator\NeoWsClient\Tests\Unit\BaseTest;

class NeoDateFilterTest extends BaseTest
{
    /**
     * @var NeoDateFilter
     */
    private $filter;

    protected function setUp()
    {
        parent::setUp();

        $this->filter = new NeoDateFilter();
    }

    /**
     * @expectedException \Picamator\NeoWsClient\Exception\InvalidArgumentException
     */
    public function testFailFilter()
    {
        $this->filter->filter('wrong data type');
    }

    public function testSuccessFilter()
    {
        $data = [
            ['2016-11-25' => [
                [1],
                [2],
                [3]
            ]],
            '2016-11-26' => [
                [4],
                [5]
            ]
        ];

        $actual = $this->filter->filter($data);
        foreach($actual as $item) {
            $this->assertArrayHasKey('date', $item);
            $this->assertArrayHasKey('neo', $item);
        }
    }
}
