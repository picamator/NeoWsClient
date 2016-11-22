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
                'schema' => [
                    'source' => 'self',
                    'destination' => 'self',
                    'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Primitive\Link'
                ]
            ]
        ];

        // filter mock
        $filterMock = $this->getMockBuilder('Picamator\NeoWsClient\Mapper\Api\FilterInterface')
            ->getMock();

        // schema mock
        $schemaFirstMock = $this->getMockBuilder('Picamator\NeoWsClient\Mapper\Api\Data\Component\SchemaInterface')
            ->getMock();

        $schemaSecondMock = $this->getMockBuilder('Picamator\NeoWsClient\Mapper\Api\Data\Component\SchemaInterface')
            ->getMock();

        $schemaThirdMock = $this->getMockBuilder('Picamator\NeoWsClient\Mapper\Api\Data\Component\SchemaInterface')
            ->getMock();

        // object manager mock
        $this->objectManagerMock->expects($this->exactly(5))
            ->method('create')
            ->withConsecutive(
                [
                   'Picamator\NeoWsClient\Mapper\Filter\DateTime'
                ], [
                    'Picamator\NeoWsClient\Mapper\Data\Component\Schema',
                    [
                        ['source' => 'name',
                        'destination' => 'name',
                        'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Neo'],
                        $filterMock,
                        null,
                    ]
                ], [
                    'Picamator\NeoWsClient\Mapper\Data\Component\Schema',
                    [
                        ['source' => 'self',
                         'destination' => 'self',
                         'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Primitive\Link'],
                        null,
                        null,
                    ]
                ], [
                    'Picamator\NeoWsClient\Mapper\Data\Component\Schema',
                    [
                        ['source' => 'link',
                        'destination' => 'link',
                        'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Neo'],
                        null,
                        $schemaThirdMock,
                    ]
                ], ['Picamator\NeoWsClient\Model\Data\Component\Collection']
            )->willReturnOnConsecutiveCalls($filterMock, $schemaFirstMock, $schemaSecondMock, $schemaThirdMock, $this->collectionMock);


        $this->schemaCollectionFactory->create($data);
    }
}
