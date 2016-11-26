<?php
namespace Picamator\NeoWsClient\Model\Api\Data\Primitive;

/**
 * Diameter value object
 */
interface DiameterInterface
{
    /**
     * Get estimated diameter min
     *
     * @return float
     */
    public function getEstimatedDiameterMin();

    /**
     * Get estimated diameter max
     *
     * @return float
     */
    public function getEstimatedDiameterMax();
}
