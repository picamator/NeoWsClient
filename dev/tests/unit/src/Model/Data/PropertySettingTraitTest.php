<?php
namespace Picamator\NeoWsClient\Tests\Unit\Model\Data;

use Picamator\NeoWsClient\Model\Data\Component\Collection;
use Picamator\NeoWsClient\Model\Data\Neo;
use Picamator\NeoWsClient\Model\Data\NeoDate;
use Picamator\NeoWsClient\Model\Data\Primitive\Diameter;
use Picamator\NeoWsClient\Tests\Unit\BaseTest;

class PropertySettingTraitTest extends BaseTest
{
    public function testValidSetPropertyData()
    {
        $data = [
            'estimatedDiameterMin' => 12,
            'estimatedDiameterMax' => 10
        ];
        $diameter = new Diameter($data);

        $this->assertEquals($data['estimatedDiameterMin'], $diameter->getEstimatedDiameterMin());
        $this->assertEquals($data['estimatedDiameterMax'], $diameter->getEstimatedDiameterMax());
    }

    /**
     * @expectedException \Picamator\NeoWsClient\Exception\InvalidArgumentException
     */
    public function testInvalidSetPropertyData()
    {
        new Diameter([
            'test1' => 12,
            'test2' => 10
        ]);
    }

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
            'neoReferenceId' => 1,
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
            'neoReferenceId' => [],
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
            'neoReferenceId' => 1,
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
            'neoReferenceId' => 1,
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
            'neoReferenceId' => 1,
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
}
