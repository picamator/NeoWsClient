<?php
namespace Picamator\NeoWsClient\Tests\Unit\Mapper\FIlter;

use Picamator\NeoWsClient\Mapper\Filter\DateTimeFilter;
use Picamator\NeoWsClient\Tests\Unit\BaseTest;

class DateTimeFilterTest extends BaseTest
{
    /**
     * @var DateTimeFilter
     */
    private $filter;

    protected function setUp()
    {
        parent::setUp();

        $this->filter = new DateTimeFilter();
    }

    public function testFailFilter()
    {
        $date = 'wrong date';
        $actual = $this->filter->filter($date);

        $this->assertEquals($date, $actual);
    }

    public function testSuccessFilter()
    {
        $date = '2016-11-26';
        $actual = $this->filter->filter($date);

        $this->assertInstanceOf('DateTime', $actual);
        $this->assertEquals($date, $actual->format('Y-m-d'));
    }
}

