<?php
namespace Picamator\NeoWsClient\Model\Data;

use Picamator\NeoWsClient\Model\Api\Data\Component\CollectionInterface;
use Picamator\NeoWsClient\Model\Api\Data\Component\EstimatedDiameterInterface;
use Picamator\NeoWsClient\Model\Api\Data\NeoInterface;
use Picamator\NeoWsClient\Model\Api\Data\Primitive\LinkInterface;
use Picamator\NeoWsClient\Model\Api\Data\Primitive\OrbitInterface;

/**
 * Neo value object
 *
 * @codeCoverageIgnore
 */
class Neo implements NeoInterface
{
    use PropertySettingTrait;

    /**
     * @var LinkInterface
     */
    private $link;

    /**
     * @var int
     */
    private $neoReferenceId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $nasaJplUrl;

    /**
     * @var float
     */
    private $absoluteMagnitudeH;

    /**
     * @var EstimatedDiameterInterface
     */
    private $estimatedDiameter;

    /**
     * @var bool
     */
    private $potentiallyHazardousAsteroid;

    /**
     * @var CollectionInterface
     */
    private $closeApproachData;

    /**
     * @var OrbitInterface
     */
    private $orbitalData;

    public function __construct(array $data)
    {
        $this->setPropertyComplex('link', $data, 'Picamator\NeoWsClient\Model\Api\Data\Primitive\LinkInterface');
        $this->setPropertySimple('neoReferenceId', $data, 'int');
        $this->setPropertySimple('name', $data, 'string');
        $this->setPropertySimple('nasaJplUrl', $data, 'string');
        $this->setPropertySimple('absoluteMagnitudeH', $data, 'float');
        $this->setPropertyComplex('estimatedDiameter', $data, 'Picamator\NeoWsClient\Model\Api\Data\Component\EstimatedDiameterInterface');
        $this->setPropertySimple('potentiallyHazardousAsteroid', $data, 'bool');
        $this->setPropertyCollection('closeApproachData', $data, 'Picamator\NeoWsClient\Model\Api\Data\Component\CloseApproachInterface');
        $this->setPropertyComplex('orbitalData', $data, 'Picamator\NeoWsClient\Model\Api\Data\Primitive\OrbitInterface');
    }

    /**
     * @inheritDoc
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @inheritDoc
     */
    public function getNeoReferenceId()
    {
        return $this->neoReferenceId;
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function getNasaJplUrl()
    {
        return $this->nasaJplUrl;
    }

    /**
     * @inheritDoc
     */
    public function getAbsoluteMagnitudeH()
    {
        return $this->absoluteMagnitudeH;
    }

    /**
     * @inheritDoc
     */
    public function getEstimatedDiameter()
    {
        return $this->estimatedDiameter;
    }

    /**
     * @inheritDoc
     */
    public function hasPotentiallyHazardousAsteroid()
    {
        return $this->potentiallyHazardousAsteroid;
    }

    /**
     * @inheritDoc
     */
    public function getCloseApproachData()
    {
        return $this->closeApproachData;
    }

    /**
     * @inheritDoc
     */
    public function getOrbitalData()
    {
        return $this->orbitalData;
    }
}
