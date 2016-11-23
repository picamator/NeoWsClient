<?php
namespace Picamator\NeoWsClient\Tests\Unit\Mapper;

use Picamator\NeoWsClient\Mapper\Mapper;
use Picamator\NeoWsClient\Tests\Unit\BaseTest;

class MapperTest extends BaseTest
{
    /**
     * @var Mapper
     */
    private $mapper;

    /**
     * @var \Picamator\NeoWsClient\Model\Api\ObjectManagerInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $objectManagerMock;

    /**
     * @var \Picamator\NeoWsClient\Model\Api\Data\Component\CollectionInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $collectionMock;

    protected function setUp()
    {
        parent::setUp();

        $this->objectManagerMock = $this->getMockBuilder('Picamator\NeoWsClient\Model\Api\ObjectManagerInterface')
            ->getMock();

        $this->collectionMock = $this->getMockBuilder('Picamator\NeoWsClient\Model\Api\Data\Component\CollectionInterface')
            ->getMock();

        $this->mapper = new Mapper($this->objectManagerMock);
    }

    /**
     * @expectedException \Picamator\NeoWsClient\Exception\InvalidArgumentException
     */
    public function testInvalidSchemaTypeMap()
    {
        // collection mock
        $this->collectionMock->expects($this->exactly(2))
            ->method('getType')
            ->willReturn('test');

        $this->mapper->map($this->collectionMock, []);
    }

    /**
     * @expectedException \Picamator\NeoWsClient\Exception\InvalidArgumentException
     */
    public function testInvalidSchemaCountMap()
    {
        // collection mock
        $this->collectionMock->expects($this->once())
            ->method('getType')
            ->willReturn('Picamator\NeoWsClient\Mapper\Api\Data\SchemaInterface');

        $this->collectionMock->expects($this->once())
            ->method('count')
            ->willReturn(0);

        $this->mapper->map($this->collectionMock, []);
    }

    public function testMap()
    {
        $data = ['link' => ['self' => 'test']];

        // filter mock
        $filterMock = $this->getMockBuilder('Picamator\NeoWsClient\Mapper\Api\FilterInterface')
            ->getMock();

        $filterMock->expects($this->once())
            ->method('filter')
            ->with($this->equalTo($data['link']))
            ->willReturn($data['link']);

        // schema link mock
        $schemaLinkMock = $this->getMockBuilder('Picamator\NeoWsClient\Mapper\Api\Data\SchemaInterface')
            ->getMock();

        $schemaLinkMock->expects($this->exactly(2))
            ->method('getSource')
            ->willReturn('self');

        $schemaLinkMock->expects($this->once())
            ->method('getDestination')
            ->willReturn('self');

        $schemaLinkMock->expects($this->once())
            ->method('getDestinationContainer')
            ->willReturn('Picamator\NeoWsClient\Model\Data\Primitive\Link');

        $schemaLinkMock->expects($this->once())
            ->method('getFilter');

        $schemaLinkMock->expects($this->once())
            ->method('getSchema');

        // schema new mock
        $schemaNeoMock = $this->getMockBuilder('Picamator\NeoWsClient\Mapper\Api\Data\SchemaInterface')
            ->getMock();

        $schemaNeoMock->expects($this->exactly(2))
            ->method('getSource')
            ->willReturn('link');

        $schemaNeoMock->expects($this->once())
            ->method('getDestination')
            ->willReturn('link');

        $schemaNeoMock->expects($this->once())
            ->method('getDestinationContainer')
            ->willReturn('Picamator\NeoWsClient\Model\Data\Neo');

        $schemaNeoMock->expects($this->once())
            ->method('getFilter')
            ->willReturn($filterMock);

        $schemaNeoMock->expects($this->once())
            ->method('getSchema')
            ->willReturn($schemaLinkMock);

        // collection mock
        $this->collectionMock->expects($this->once())
            ->method('getType')
            ->willReturn('Picamator\NeoWsClient\Mapper\Api\Data\SchemaInterface');

        $this->collectionMock->expects($this->once())
            ->method('count')
            ->willReturn(1);


        $this->collectionMock->expects($this->once())
            ->method('getIterator')
            ->willReturn(new \ArrayIterator([$schemaNeoMock]));

        // object manager
        $this->objectManagerMock->expects($this->exactly(2))
            ->method('create')
            ->withConsecutive(
                ['Picamator\NeoWsClient\Model\Data\Primitive\Link'],
                ['Picamator\NeoWsClient\Model\Data\Neo']
            );

        $this->mapper->map($this->collectionMock, $data);
    }
}
