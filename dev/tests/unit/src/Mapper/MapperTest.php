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
        $data = ['name' => 'test name'];

        // filter mock
        $filterMock = $this->getMockBuilder('Picamator\NeoWsClient\Mapper\Api\FilterInterface')
            ->getMock();

        $filterMock->expects($this->once())
            ->method('filter')
            ->with($this->equalTo($data['name']))
            ->willReturn($data['name']);

        // schema new mock
        $schemaNeoMock = $this->getMockBuilder('Picamator\NeoWsClient\Mapper\Api\Data\SchemaInterface')
            ->getMock();

        $schemaNeoMock->expects($this->exactly(2))
            ->method('getSource')
            ->willReturn('name');

        $schemaNeoMock->expects($this->once())
            ->method('getDestination')
            ->willReturn('name');

        $schemaNeoMock->expects($this->once())
            ->method('getDestinationContainer')
            ->willReturn('Picamator\NeoWsClient\Model\Data\Neo');

        $schemaNeoMock->expects($this->once())
            ->method('getFilter')
            ->willReturn($filterMock);

        $schemaNeoMock->expects($this->once())
            ->method('getSchema');

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
        $this->objectManagerMock->expects($this->once())
            ->method('create')
            ->with($this->equalTo('Picamator\NeoWsClient\Model\Data\Neo'));

        $this->mapper->map($this->collectionMock, $data);
    }

    public function testCollectionMap()
    {
        $data = ['close_approach_data' => [['orbiting_body' => 'Mars']]];

        // schema close approach data
        $schemaCloseApproachDataMock = $this->getMockBuilder('Picamator\NeoWsClient\Mapper\Api\Data\SchemaInterface')
            ->getMock();

        $schemaCloseApproachDataMock->expects($this->exactly(2))
            ->method('getSource')
            ->willReturn('orbiting_body');

        $schemaCloseApproachDataMock->expects($this->once())
            ->method('getDestination')
            ->willReturn('orbitingBody');

        $schemaCloseApproachDataMock->expects($this->once())
            ->method('getDestinationContainer')
            ->willReturn('Picamator\NeoWsClient\Model\Data\Component\CloseApproach');


        $schemaCloseApproachDataMock->expects($this->once())
            ->method('getFilter');

        $schemaCloseApproachDataMock->expects($this->once())
            ->method('getSchema');

        // schema collection
        $schemaCollectionMock = $this->getMockBuilder('Picamator\NeoWsClient\Model\Api\Data\Component\CollectionInterface')
            ->getMock();

        $schemaCollectionMock->expects($this->once())
            ->method('getIterator')
            ->willReturn(new \ArrayIterator([$schemaCloseApproachDataMock]));

        // schema new mock
        $schemaNeoMock = $this->getMockBuilder('Picamator\NeoWsClient\Mapper\Api\Data\SchemaInterface')
            ->getMock();

        $schemaNeoMock->expects($this->exactly(2))
            ->method('getSource')
            ->willReturn('close_approach_data');

        $schemaNeoMock->expects($this->once())
            ->method('getDestination')
            ->willReturn('closeApproachData');

        $schemaNeoMock->expects($this->once())
            ->method('getDestinationContainer')
            ->willReturn('Picamator\NeoWsClient\Model\Data\Neo');

        $schemaNeoMock->expects($this->once())
            ->method('getCollectionOf')
            ->willReturn('Picamator\NeoWsClient\Model\Api\Data\Component\CloseApproachInterface');

        $schemaNeoMock->expects($this->once())
            ->method('getFilter');

        $schemaNeoMock->expects($this->once())
            ->method('getSchema')
            ->willReturn($schemaCollectionMock);

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
        $this->objectManagerMock->expects($this->exactly(3))
            ->method('create')
            ->withConsecutive(
                ['Picamator\NeoWsClient\Model\Data\Component\CloseApproach'],
                ['Picamator\NeoWsClient\Model\Data\Component\Collection'],
                ['Picamator\NeoWsClient\Model\Data\Neo']
            );

        // never
        $schemaCloseApproachDataMock->expects($this->never())
            ->method('getCollectionOf');


        $this->mapper->map($this->collectionMock, $data);
    }
}
