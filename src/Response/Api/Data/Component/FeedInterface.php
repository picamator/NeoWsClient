<?php
namespace Picamator\NeoWsClient\Response\Api\Data\Component;

use Picamator\NeoWsClient\Model\Api\Data\Component\CollectionInterface;
use Picamator\NeoWsClient\Response\Api\Data\Primitive\PaginatedLinkInterface;

/**
 * Feed value object
 */
interface FeedInterface
{
    /**
     * Get link
     *
     * @return PaginatedLinkInterface
     */
    public function getLink();

    /**
     * Get element count
     *
     * @return int
     */
    public function getElementCount();

    /**
     * Get collection of Neo's objects
     *
     * @return CollectionInterface
     */
    public function getNeoList();
}
