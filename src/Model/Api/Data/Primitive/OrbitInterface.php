<?php
namespace Picamator\NeoWsClient\Model\Api\Data\Primitive;

/**
 * Orbit value object
 */
interface OrbitInterface
{
    /**
     * Get orbit id
     *
     * @return int
     */
    public function getOrbitId();

    /**
     * Get orbit determination date
     *
     * @return \DateTime
     */
    public function getOrbitDeterminationDate();

    /**
     * Get orbit uncertainty
     *
     * @return int
     */
    public function getOrbitUncertainty();

    /**
     * Get minimum orbit intersection
     *
     * @return float
     */
    public function getMinimumOrbitIntersection();

    /**
     * Get Jupiter Tisserand's invariant
     *
     * @return  float
     */
    public function getJupiterTisserandInvariant();

    /**
     * Get epoch osculation
     *
     * @return float
     */
    public function getEpochOsculation();

    /**
     * Get eccentricity
     *
     * @return float
     */
    public function getEccentricity();

    /**
     * Get semi major Axis
     *
     * @return float
     */
    public function getSemiMajorAxis();

    /**
     * Get inclination
     *
     * @return float
     */
    public function getInclination();

    /**
     * Get ascending node longitude
     *
     * @return float
     */
    public function getAscendingNodeLongitude();

    /**
     * Get orbital period
     *
     * @return float
     */
    public function getOrbitalPeriod();

    /**
     * Get perihelion distance
     *
     * @return float
     */
    public function getPerihelionDistance();

    /**
     * Get perihelion argument
     *
     * @return float
     */
    public function getPerihelionArgument();

    /**
     * Get aphelion distance
     *
     * @return float
     */
    public function getAphelionDistance();

    /**
     * Get perihelion time
     *
     * @return float
     */
    public function getPerihelionTime();

    /**
     * Get mean anomaly
     *
     * @return float
     */
    public function getMeanAnomaly();

    /**
     * Get mean motion
     *
     * @return float
     */
    public function getMeanMotion();

    /**
     * Get equinox
     *
     * @return string
     */
    public function getEquinox();
}
