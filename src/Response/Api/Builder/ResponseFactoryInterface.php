<?php
namespace Picamator\NeoWsClient\Response\Api\Builder;

use Picamator\NeoWsClient\Response\Api\Data\Primitive\RateLimitInterface;
use Picamator\NeoWsClient\Response\Api\Data\ResponseInterface;

/**
 * Create Response
 */
interface ResponseFactoryInterface
{
    /**
     * Create
     *
     * @param RateLimitInterface $rateLimit
     * @param int $code
     * @param mixed $data
     *
     * @return ResponseInterface
     */
    public function create(RateLimitInterface $rateLimit, $code, $data);
}
