<?php
namespace Picamator\NeoWsClient\Tests\Unit\Model\Data;

use Picamator\NeoWsClient\Mapper\Data\Schema;
use Picamator\NeoWsClient\Model\Data\Component\Collection;
use Picamator\NeoWsClient\Model\Data\Neo;
use Picamator\NeoWsClient\Model\Data\NeoDate;
use Picamator\NeoWsClient\Model\Data\Primitive\Diameter;
use Picamator\NeoWsClient\Model\Data\Statistics;
use Picamator\NeoWsClient\Response\Data\Primitive\PaginatedLink;
use Picamator\NeoWsClient\Tests\Unit\BaseTest;

class PropertySettingTraitTest extends BaseTest
{
    public function testSetValidSetProperty()
    {
        $linkMock = $this->getMockBuilder('Picamator\NeoWsClient\Model\Api\Data\Primitive\LinkInterface')
            ->getMock();

        $diameterMock = $this->getMockBuilder('Picamator\NeoWsClient\Model\Api\Data\Component\EstimatedDiameterInterface')
            ->getMock();

        // close approach data mock
        $closeApproachDataMock = $this->getMockBuilder('Picamator\NeoWsClient\Model\Api\Data\Component\CollectionInterface')
            ->getMock();

        $closeApproachDataMock->expects($this->once())
            ->method('getType')
            ->willReturn('Picamator\NeoWsClient\Model\Api\Data\Component\CloseApproachInterface');

        $orbitalDataMock = $this->getMockBuilder('Picamator\NeoWsClient\Model\Api\Data\Primitive\OrbitInterface')
            ->getMock();

        $data = [
            'link' =>  $linkMock,
            'neoReferenceId' => '1',
            'name' => 'test',
            'nasaJplUrl' => 'test url',
            'absoluteMagnitudeH' => 1.5,
            'estimatedDiameter' => $diameterMock,
            'potentiallyHazardousAsteroid' => true,
            'closeApproachData' => $closeApproachDataMock,
            'orbitalData' => $orbitalDataMock,
        ];

        $neo = new Neo($data);
        $this->assertEquals($data['link'], $neo->getLink());
        $this->assertEquals($data['neoReferenceId'], $neo->getNeoReferenceId());
        $this->assertEquals($data['name'], $neo->getName());
        $this->assertEquals($data['nasaJplUrl'], $neo->getNasaJplUrl());
        $this->assertEquals($data['absoluteMagnitudeH'], $neo->getAbsoluteMagnitudeH());
        $this->assertEquals($data['estimatedDiameter'], $neo->getEstimatedDiameter());
        $this->assertEquals($data['potentiallyHazardousAsteroid'], $neo->hasPotentiallyHazardousAsteroid());
        $this->assertEquals($data['closeApproachData'], $neo->getCloseApproachData());
        $this->assertEquals($data['orbitalData'], $neo->getOrbitalData());
    }

    /**
     * @expectedException \Picamator\NeoWsClient\Exception\InvalidArgumentException
     */
    public function testInvalidSetPropertySimpleArray()
    {
        $data = [
            'type' => 'test',
            'data' => 'data'
        ];

        new Collection($data);
    }

    /**
     * @expectedException \Picamator\NeoWsClient\Exception\InvalidArgumentException
     */
    public function testInvalidSetPropertySimpleString()
    {
        $data = [
            'type' => [],
            'data' => []
        ];

        new Collection($data);
    }

    /**
     * @expectedException \Picamator\NeoWsClient\Exception\InvalidArgumentException
     */
    public function testInvalidSetPropertySimpleInt()
    {
        $data = [
            'neoCount' =>  '1',
            'closeApproachCount' => '1',
            'lastUpdated' => new \DateTime(),
            'source' => 'test source',
            'nasaJplUrl' => 'test url',
        ];

        new Statistics($data);
    }

    /**
     * @expectedException \Picamator\NeoWsClient\Exception\InvalidArgumentException
     */
    public function testInvalidSetPropertySimpleFloat()
    {
        $linkMock = $this->getMockBuilder('Picamator\NeoWsClient\Model\Api\Data\Primitive\LinkInterface')
            ->getMock();

        $diameterMock = $this->getMockBuilder('Picamator\NeoWsClient\Model\Api\Data\Component\EstimatedDiameterInterface')
            ->getMock();

        // close approach data mock
        $closeApproachDataMock = $this->getMockBuilder('Picamator\NeoWsClient\Model\Api\Data\Component\CollectionInterface')
            ->getMock();

        $closeApproachDataMock->expects($this->never())
            ->method('getType');

        $orbitalDataMock = $this->getMockBuilder('Picamator\NeoWsClient\Model\Api\Data\Primitive\OrbitInterface')
            ->getMock();

        $data = [
            'link' =>  $linkMock,
            'neoReferenceId' => '1',
            'name' => 'test',
            'nasaJplUrl' => 'test url',
            'absoluteMagnitudeH' => [],
            'estimatedDiameter' => $diameterMock,
            'potentiallyHazardousAsteroid' => true,
            'closeApproachData' => $closeApproachDataMock,
            'orbitalData' => $orbitalDataMock,
        ];

        new Neo($data);
    }

    /**
     * @expectedException \Picamator\NeoWsClient\Exception\InvalidArgumentException
     */
    public function testInvalidSetPropertyCollection()
    {
        $linkMock = $this->getMockBuilder('Picamator\NeoWsClient\Model\Api\Data\Primitive\LinkInterface')
            ->getMock();

        $diameterMock = $this->getMockBuilder('Picamator\NeoWsClient\Model\Api\Data\Component\EstimatedDiameterInterface')
            ->getMock();

        // close approach data mock
        $closeApproachDataMock = $this->getMockBuilder('Picamator\NeoWsClient\Model\Api\Data\Component\CloseApproachInterface')
            ->getMock();

        $orbitalDataMock = $this->getMockBuilder('Picamator\NeoWsClient\Model\Api\Data\Primitive\OrbitInterface')
            ->getMock();

        $data = [
            'link' =>  $linkMock,
            'neoReferenceId' => '1',
            'name' => 'test',
            'nasaJplUrl' => 'test url',
            'absoluteMagnitudeH' => 1.5,
            'estimatedDiameter' => $diameterMock,
            'potentiallyHazardousAsteroid' => true,
            'closeApproachData' => $closeApproachDataMock,
            'orbitalData' => $orbitalDataMock,
        ];

        new Neo($data);
    }

    /**
     * @expectedException \Picamator\NeoWsClient\Exception\InvalidArgumentException
     */
    public function testInvalidTypeSetPropertyCollection()
    {
        $linkMock = $this->getMockBuilder('Picamator\NeoWsClient\Model\Api\Data\Primitive\LinkInterface')
            ->getMock();

        $diameterMock = $this->getMockBuilder('Picamator\NeoWsClient\Model\Api\Data\Component\EstimatedDiameterInterface')
            ->getMock();

        // close approach data mock
        $closeApproachDataMock = $this->getMockBuilder('Picamator\NeoWsClient\Model\Api\Data\Component\CollectionInterface')
            ->getMock();

        $closeApproachDataMock->expects($this->exactly(2))
            ->method('getType')
            ->willReturn('Picamator\NeoWsClient\Model\Api\Data\Primitive\LinkInterface');

        $orbitalDataMock = $this->getMockBuilder('Picamator\NeoWsClient\Model\Api\Data\Primitive\OrbitInterface')
            ->getMock();

        $data = [
            'link' =>  $linkMock,
            'neoReferenceId' => '1',
            'name' => 'test',
            'nasaJplUrl' => 'test url',
            'absoluteMagnitudeH' => 1.5,
            'estimatedDiameter' => $diameterMock,
            'potentiallyHazardousAsteroid' => true,
            'closeApproachData' => $closeApproachDataMock,
            'orbitalData' => $orbitalDataMock,
        ];

       new Neo($data);
    }

    /**
     * @expectedException \Picamator\NeoWsClient\Exception\InvalidArgumentException
     */
    public function testInvalidSetPropertyComplex()
    {
        // neo list mock
        $neoListMock = $this->getMockBuilder('Picamator\NeoWsClient\Model\Api\Data\Component\CollectionInterface')
            ->getMock();

        $neoListMock->expects($this->never())
            ->method('getType');

        $data = [
            'date' => new \stdClass(),
            'neoList' => $neoListMock
        ];

        new NeoDate($data);
    }

    public function testSetPropertySimpleDefault()
    {
        $data = [
            'self' => 'self url',
            'next' => 'next url'
        ];

        $paginatedLink = new PaginatedLink($data);

        $this->assertEquals($data['self'], $paginatedLink->getSelf());
        $this->assertEquals($data['next'], $paginatedLink->getNext());
        $this->assertEmpty($paginatedLink->getPrev());
    }

    public function testSetPropertyComplexDefault()
    {
        $filterMock = $this->getMockBuilder('Picamator\NeoWsClient\Mapper\Api\FilterInterface')
            ->getMock();

        $data = [
            'source' => 'name',
            'destination' => 'name',
            'destinationContainer' => 'SomeName',
            'filter' => $filterMock
        ];

        $schema = new Schema($data);

        $this->assertEquals($data['source'], $schema->getSource());
        $this->assertEquals($data['destination'], $schema->getDestination());
        $this->assertEquals($data['destinationContainer'], $schema->getDestinationContainer());
        $this->assertEquals($data['filter'], $schema->getFilter());
        $this->assertEmpty($schema->getSchema());
    }
}
