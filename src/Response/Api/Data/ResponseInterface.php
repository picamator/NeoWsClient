<?php
namespace Picamator\NeoWsClient\Response\Api\Data;

use Picamator\NeoWsClient\Response\Api\Data\Primitive\RateLimitInterface;

/**
 * Response value object
 */
interface ResponseInterface
{
    /**
     * Get rate limit
     *
     * @return RateLimitInterface
     */
    public function getRateLimit();

    /**
     * Get response code
     * - 200	OK
     * - 401	Unauthorized
     * - 403	Forbidden
     * - 404	Not Found
     *
     * @return int
     */
    public function getCode();

    /**
     * Get data
     *
     * @return mixed
     */
    public function getData();
}
