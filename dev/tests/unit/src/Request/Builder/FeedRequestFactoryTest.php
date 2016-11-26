<?php
namespace Picamator\NeoWsClient\Tests\Unit\Request\Builder;

use Picamator\NeoWsClient\Request\Builder\FeedRequestFactory;
use Picamator\NeoWsClient\Tests\Unit\BaseTest;

class FeedRequestFactoryTest extends BaseTest
{
    /**
     * @var FeedRequestFactory
     */
    private $requestFactory;

    /**
     * @var \Picamator\NeoWsClient\Model\Api\ObjectManagerInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $objectManagerMock;

    protected function setUp()
    {
        parent::setUp();

        $this->objectManagerMock = $this->getMockBuilder('Picamator\NeoWsClient\Model\Api\ObjectManagerInterface')
            ->getMock();

        $this->requestFactory = new FeedRequestFactory($this->objectManagerMock);
    }

    /**
     * @expectedException \Picamator\NeoWsClient\Exception\InvalidArgumentException
     */
    public function testInvalidDateCreate()
    {
        $startDate = '2016-11-23';
        $endDate = '201611-23';

        // never
        $this->objectManagerMock->expects($this->never())
            ->method('create');

        $this->requestFactory->create($startDate, $endDate);
    }

    /**
     * @expectedException \Picamator\NeoWsClient\Exception\InvalidArgumentException
     */
    public function testEndLessStartDateCreate()
    {
        $startDate = '2016-11-23';
        $endDate = '2016-12-30';

        // never
        $this->objectManagerMock->expects($this->never())
            ->method('create');

        $this->requestFactory->create($endDate, $startDate);
    }

    /**
     * @expectedException \Picamator\NeoWsClient\Exception\InvalidArgumentException
     */
    public function testInvalidDateRangeCreate()
    {
        $startDate = '2016-11-23';
        $endDate = '2016-12-30';

        // never
        $this->objectManagerMock->expects($this->never())
            ->method('create');

        $this->requestFactory->create($startDate, $endDate);
    }

    public function testCreate()
    {
        $startDate = '2016-11-23';
        $endDate = '2016-11-25';

        // object manager
        $this->objectManagerMock->expects($this->once())
            ->method('create')
            ->with($this->equalTo('Picamator\NeoWsClient\Request\Data\FeedRequest'), $this->equalTo([[
                'startDate' => $startDate,
                'endDate' => $endDate
            ]]));

        $this->requestFactory->create($startDate, $endDate);
    }
}
