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
     * @return float
     */
    public function getLunar();

    /**
     * Get kilometers
     *
     * @return float
     */
    public function getKilometers();

    /**
     * Get miles
     *
     * @return float
     */
    public function getMiles();
}
