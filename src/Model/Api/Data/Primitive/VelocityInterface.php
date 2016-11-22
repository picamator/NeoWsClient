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
     * @return string
     */
    public function getKilometersPerSecond();

    /**
     * Get kilometers per hour
     *
     * @return string
     */
    public function getKilometersPerHour();

    /**
     * Get miles per hour
     *
     * @return string
     */
    public function getMilesPerHour();
}
