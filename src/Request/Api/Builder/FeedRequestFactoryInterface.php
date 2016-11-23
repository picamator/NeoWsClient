<?php
namespace Picamator\NeoWsClient\Request\Api\Builder;

use Picamator\NeoWsClient\Exception\InvalidArgumentException;
use Picamator\NeoWsClient\Request\Api\Data\FeedRequestInterface;

/**
 * Create Feed Request
 */
interface FeedRequestFactoryInterface
{
    /**
     * Create
     *
     * @param string $startDate
     * @param string $endDate
     *
     * @return FeedRequestInterface
     *
     * @throws InvalidArgumentException
     */
    public function create($startDate, $endDate);
}
