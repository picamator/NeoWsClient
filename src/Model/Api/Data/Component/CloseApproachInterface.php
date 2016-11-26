<?php
namespace Picamator\NeoWsClient\Model\Api\Data\Component;

use Picamator\NeoWsClient\Model\Api\Data\Primitive\DistanceInterface;
use Picamator\NeoWsClient\Model\Api\Data\Primitive\VelocityInterface;

/**
 * Close approach value object
 */
interface CloseApproachInterface
{
    /**
     * Get close approach date
     *
     * @return \DateTime
     */
    public function getCloseApproachDate();

    /**
     * Get epoch date close approach
     *
     * @return int
     */
    public function getEpochDateCloseApproach();

    /**
     * Get relative velocity
     *
     * @return VelocityInterface
     */
    public function getRelativeVelocity();

    /**
     * Get miss distance
     *
     * @return DistanceInterface
     */
    public function getMissDistance();

    /**
     * Get orbiting body
     *
     * @return string
     */
    public function getOrbitingBody();
}
