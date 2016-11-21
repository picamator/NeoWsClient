<?php
namespace Picamator\NeoWsClient\Response\Api\Data\Primitive;

/**
 * Rate limit value object
 */
interface RateLimitInterface
{
    /**
     * Get token's request limit
     *
     * @return int
     */
    public function getLimit();

    /**
     * Get token's remaining requests
     *
     * @return int
     */
    public function getRemaining();
}
