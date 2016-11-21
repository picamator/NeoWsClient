<?php
namespace Picamator\NeoWsClient\Model\Api\Data;

use Picamator\NeoWsClient\Model\Api\Data\Component\CollectionInterface;
use Picamator\NeoWsClient\Model\Api\Data\Component\EstimatedDiameterInterface;
use Picamator\NeoWsClient\Model\Api\Data\Primitive\LinkInterface;
use Picamator\NeoWsClient\Model\Api\Data\Primitive\OrbitInterface;

/**
 * Neo value object
 */
interface NeoInterface
{
    /**
     * Get link
     *
     * @return LinkInterface
     */
    public function getLink();

    /**
     * Get Neo reference id
     *
     * @return int
     */
    public function getNeoReferenceId();

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Get NASA jpl url
     *
     * @return string
     */
    public function getNasaJplUrl();

    /**
     * Get absolute magnitude h
     *
     * @return float
     */
    public function getAbsoluteMagnitudeH();

    /**
     * Get estimated diameter
     *
     * @return EstimatedDiameterInterface
     */
    public function getEstimatedDiameter();

    /**
     * Has potentially hazardous asteroid
     *
     * @return bool
     */
    public function hasPotentiallyHazardousAsteroid();

    /**
     * Get close approach data
     *
     * @return CollectionInterface
     */
    public function getCloseApproachData();

    /**
     * Get orbital data
     *
     * @return OrbitInterface
     */
    public function getOrbitalData();
}
