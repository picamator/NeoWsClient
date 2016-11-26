<?php
namespace Picamator\NeoWsClient\Manager\Api\Builder;

use Picamator\NeoWsClient\Model\Api\Data\Primitive\RateLimitInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Create Rate Limit
 */
interface RateLimitFactoryInterface
{
    /**
     * Create
     *
     * @param ResponseInterface $response
     *
     * @return RateLimitInterface
     */
    public function create(ResponseInterface $response);
}
