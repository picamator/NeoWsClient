<?php
namespace Picamator\NeoWsClient\Model\Api\Data\Component;

use Picamator\NeoWsClient\Model\Api\Data\Primitive\DiameterInterface;

/**
 * Estimated diameter value object
 */
interface EstimatedDiameterInterface
{
    /**
     * Get kilometers
     *
     * @return DiameterInterface
     */
    public function getKilometers();

    /**
     * Get meters
     *
     * @return DiameterInterface
     */
    public function getMeters();

    /**
     * Get miles
     *
     * @return DiameterInterface
     */
    public function getMiles();

    /**
     * Get feet
     *
     * @return DiameterInterface
     */
    public function getFeet();
}
