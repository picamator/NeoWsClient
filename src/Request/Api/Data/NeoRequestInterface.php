<?php
namespace Picamator\NeoWsClient\Request\Api\Data;

/**
 * Neo Request
 */
interface NeoRequestInterface extends RequestAwareInterface
{
    /**
     * Get asteroid id
     *
     * @return string
     */
    public function getAsteroidId();
}
