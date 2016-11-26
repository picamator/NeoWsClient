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
     * @return string
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
     * @return string
     */
    public function getOrbitUncertainty();

    /**
     * Get minimum orbit intersection
     *
     * @return string
     */
    public function getMinimumOrbitIntersection();

    /**
     * Get Jupiter Tisserand's invariant
     *
     * @return  string
     */
    public function getJupiterTisserandInvariant();

    /**
     * Get epoch osculation
     *
     * @return string
     */
    public function getEpochOsculation();

    /**
     * Get eccentricity
     *
     * @return string
     */
    public function getEccentricity();

    /**
     * Get semi major Axis
     *
     * @return string
     */
    public function getSemiMajorAxis();

    /**
     * Get inclination
     *
     * @return string
     */
    public function getInclination();

    /**
     * Get ascending node longitude
     *
     * @return string
     */
    public function getAscendingNodeLongitude();

    /**
     * Get orbital period
     *
     * @return string
     */
    public function getOrbitalPeriod();

    /**
     * Get perihelion distance
     *
     * @return string
     */
    public function getPerihelionDistance();

    /**
     * Get perihelion argument
     *
     * @return string
     */
    public function getPerihelionArgument();

    /**
     * Get aphelion distance
     *
     * @return string
     */
    public function getAphelionDistance();

    /**
     * Get perihelion time
     *
     * @return string
     */
    public function getPerihelionTime();

    /**
     * Get mean anomaly
     *
     * @return string
     */
    public function getMeanAnomaly();

    /**
     * Get mean motion
     *
     * @return string
     */
    public function getMeanMotion();

    /**
     * Get equinox
     *
     * @return string
     */
    public function getEquinox();
}
