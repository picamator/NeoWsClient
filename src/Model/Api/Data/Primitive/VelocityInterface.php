<?php
namespace Picamator\NeoWsClient\Model\Api\Data\Primitive;

/**
 * Velocity value object
 */
interface VelocityInterface
{
    /**
     * Get kilometers per second
     *
     * @return float
     */
    public function getKilometersPerSecond();

    /**
     * Get kilometers per hour
     *
     * @return float
     */
    public function getKilometersPerHour();

    /**
     * Get miles per hour
     *
     * @return float
     */
    public function getMilesPerHour();
}
