<?php
namespace Picamator\NeoWsClient\Model\Api\Data\Primitive;

/**
 * Distance value object
 */
interface DistanceInterface
{
    /**
     * Get astronomical
     *
     * @return float
     */
    public function getAstronomical();

    /**
     * Get lunar
     *
     * @return string
     */
    public function getLunar();

    /**
     * Get kilometers
     *
     * @return string
     */
    public function getKilometers();

    /**
     * Get miles
     *
     * @return string
     */
    public function getMiles();
}
