<?php
namespace Picamator\NeoWsClient\Model\Data\Primitive;

use Picamator\NeoWsClient\Model\Api\Data\Primitive\OrbitInterface;
use Picamator\NeoWsClient\Model\Data\PropertySettingTrait;

/**
 * Orbit value object
 *
 * @codeCoverageIgnore
 */
class Orbit implements OrbitInterface
{
    use PropertySettingTrait;

    /**
     * @var int
     */
    private $orbitId;

    /**
     * @var \DateTime
     */
    private $orbitDeterminationDate;

    /**
     * @var int
     */
    private $orbitUncertainty;

    /**
     * @var float
     */
    private $minimumOrbitIntersection;

    /**
     * @var float
     */
    private $jupiterTisserandInvariant;

    /**
     * @var float
     */
    private $epochOsculation;

    /**
     * @var float
     */
    private $eccentricity;

    /**
     * @var float
     */
    private $semiMajorAxis;

    /**
     * @var float
     */
    private $inclination;

    /**
     * @var float
     */
    private $ascendingNodeLongitude;

    /**
     * @var float
     */
    private $orbitalPeriod;

    /**
     * @var float
     */
    private $perihelionDistance;

    /**
     * @var float
     */
    private $perihelionArgument;

    /**
     * @var float
     */
    private $aphelionDistance;

    /**
     * @var float
     */
    private $perihelionTime;

    /**
     * @var float
     */
    private $meanAnomaly;

    /**
     * @var float
     */
    private $meanMotion;

    /**
     * @var string
     */
    private $equinox;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setPropertyData($data);
    }

    /**
     * @inheritDoc
     */
    public function getOrbitId()
    {
       return $this->orbitId;
    }

    /**
     * @inheritDoc
     */
    public function getOrbitDeterminationDate()
    {
        return $this->orbitDeterminationDate;
    }

    /**
     * @inheritDoc
     */
    public function getOrbitUncertainty()
    {
        return $this->orbitUncertainty;
    }

    /**
     * @inheritDoc
     */
    public function getMinimumOrbitIntersection()
    {
        return $this->minimumOrbitIntersection;
    }

    /**
     * @inheritDoc
     */
    public function getJupiterTisserandInvariant()
    {
       return $this->jupiterTisserandInvariant;
    }

    /**
     * @inheritDoc
     */
    public function getEpochOsculation()
    {
        return $this->epochOsculation;
    }

    /**
     * @inheritDoc
     */
    public function getEccentricity()
    {
        return $this->eccentricity;
    }

    /**
     * @inheritDoc
     */
    public function getSemiMajorAxis()
    {
        return $this->semiMajorAxis;
    }

    /**
     * @inheritDoc
     */
    public function getInclination()
    {
        return $this->inclination;
    }

    /**
     * @inheritDoc
     */
    public function getAscendingNodeLongitude()
    {
        return $this->ascendingNodeLongitude;
    }

    /**
     * @inheritDoc
     */
    public function getOrbitalPeriod()
    {
        return $this->orbitalPeriod;
    }

    /**
     * @inheritDoc
     */
    public function getPerihelionDistance()
    {
        return $this->perihelionDistance;
    }

    /**
     * @inheritDoc
     */
    public function getPerihelionArgument()
    {
        return $this->perihelionArgument;
    }

    /**
     * @inheritDoc
     */
    public function getAphelionDistance()
    {
        return $this->aphelionDistance;
    }

    /**
     * @inheritDoc
     */
    public function getPerihelionTime()
    {
        return $this->perihelionTime;
    }

    /**
     * @inheritDoc
     */
    public function getMeanAnomaly()
    {
        return $this->meanAnomaly;
    }

    /**
     * @inheritDoc
     */
    public function getMeanMotion()
    {
        return $this->meanMotion;
    }

    /**
     * @inheritDoc
     */
    public function getEquinox()
    {
        return $this->equinox;
    }
}
