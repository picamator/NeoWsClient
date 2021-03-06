<?php
namespace Picamator\NeoWsClient\Tests\Unit\Mapper\Builder;

use Picamator\NeoWsClient\Mapper\Builder\SchemaCollectionFactory;
use Picamator\NeoWsClient\Tests\Unit\BaseTest;

class SchemaCollectionFactoryTest extends BaseTest
{
    /**
     * @var SchemaCollectionFactory
     */
    private $schemaCollectionFactory;

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

        $this->schemaCollectionFactory = new SchemaCollectionFactory($this->objectManagerMock);
    }

    public function testCreate()
    {
        $data = [
            [
                'source' => 'name',
                'destination' => 'name',
                'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Neo',
                'filter' => 'Picamator\NeoWsClient\Mapper\Filter\DateTime'
            ], [
                'source' => 'link',
                'destination' => 'link',
                'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Neo',
                'schema' => [[
                    'source' => 'self',
                    'destination' => 'self',
                    'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Primitive\Link'
                ]]
            ]
        ];

        // filter mock
        $filterMock = $this->getMockBuilder('Picamator\NeoWsClient\Mapper\Api\FilterInterface')
            ->getMock();

        // schema mock
        $schemaFirstMock = $this->getMockBuilder('Picamator\NeoWsClient\Mapper\Api\Data\SchemaInterface')
            ->getMock();

        $schemaSecondMock = $this->getMockBuilder('Picamator\NeoWsClient\Mapper\Api\Data\SchemaInterface')
            ->getMock();

        $schemaThirdMock = $this->getMockBuilder('Picamator\NeoWsClient\Mapper\Api\Data\SchemaInterface')
            ->getMock();

        // object manager mock
        $this->objectManagerMock->expects($this->exactly(6))
            ->method('create')
            ->withConsecutive(
                [
                   'Picamator\NeoWsClient\Mapper\Filter\DateTime'
                ], [
                    'Picamator\NeoWsClient\Mapper\Data\Schema',
                    [
                        [   'source' => 'name',
                            'destination' => 'name',
                            'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Neo',
                            'filter' => $filterMock,
                        ]
                    ]
                ], [
                    'Picamator\NeoWsClient\Mapper\Data\Schema',
                    [
                        [
                            'source' => 'self',
                            'destination' => 'self',
                            'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Primitive\Link',
                        ]
                    ]
                ], [
                    'Picamator\NeoWsClient\Model\Data\Component\Collection'
                ], [
                    'Picamator\NeoWsClient\Mapper\Data\Schema',
                    [
                        [
                            'source' => 'link',
                            'destination' => 'link',
                            'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Neo',
                            'schema' => $this->collectionMock,
                        ]
                    ]
                ], ['Picamator\NeoWsClient\Model\Data\Component\Collection']
            )->willReturnOnConsecutiveCalls($filterMock, $schemaFirstMock, $schemaSecondMock, $this->collectionMock, $schemaThirdMock,  $this->collectionMock);

        $this->schemaCollectionFactory->create($data);
    }
}
