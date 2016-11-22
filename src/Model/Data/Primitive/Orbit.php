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
     * @var string
     */
    private $orbitId;

    /**
     * @var \DateTime
     */
    private $orbitDeterminationDate;

    /**
     * @var string
     */
    private $orbitUncertainty;

    /**
     * @var string
     */
    private $minimumOrbitIntersection;

    /**
     * @var string
     */
    private $jupiterTisserandInvariant;

    /**
     * @var string
     */
    private $epochOsculation;

    /**
     * @var string
     */
    private $eccentricity;

    /**
     * @var string
     */
    private $semiMajorAxis;

    /**
     * @var string
     */
    private $inclination;

    /**
     * @var string
     */
    private $ascendingNodeLongitude;

    /**
     * @var string
     */
    private $orbitalPeriod;

    /**
     * @var string
     */
    private $perihelionDistance;

    /**
     * @var string
     */
    private $perihelionArgument;

    /**
     * @var string
     */
    private $aphelionDistance;

    /**
     * @var string
     */
    private $perihelionTime;

    /**
     * @var string
     */
    private $meanAnomaly;

    /**
     * @var string
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
        $this->setPropertySimple('orbitId', $data, 'string');
        $this->setPropertyComplex('orbitDeterminationDate', $data, 'DataTime');
        $this->setPropertySimple('orbitUncertainty', $data, 'string');
        $this->setPropertySimple('minimumOrbitIntersection', $data, 'string');
        $this->setPropertySimple('minimumOrbitIntersection', $data, 'string');
        $this->setPropertySimple('jupiterTisserandInvariant', $data, 'string');
        $this->setPropertySimple('epochOsculation', $data, 'string');
        $this->setPropertySimple('eccentricity', $data, 'string');
        $this->setPropertySimple('semiMajorAxis', $data, 'string');
        $this->setPropertySimple('inclination', $data, 'string');
        $this->setPropertySimple('ascendingNodeLongitude', $data, 'string');
        $this->setPropertySimple('orbitalPeriod', $data, 'string');
        $this->setPropertySimple('perihelionDistance', $data, 'string');
        $this->setPropertySimple('perihelionArgument', $data, 'string');
        $this->setPropertySimple('aphelionDistance', $data, 'string');
        $this->setPropertySimple('perihelionTime', $data, 'string');
        $this->setPropertySimple('meanAnomaly', $data, 'string');
        $this->setPropertySimple('meanMotion', $data, 'string');
        $this->setPropertySimple('equinox', $data, 'string');
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
