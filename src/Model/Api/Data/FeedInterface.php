<?php
namespace Picamator\NeoWsClient\Model\Api\Data;

use Picamator\NeoWsClient\Model\Api\Data\Component\CollectionInterface;
use Picamator\NeoWsClient\Model\Api\Data\Primitive\PaginatedLinkInterface;

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
     * Get collection of Neo date objects
     *
     * @return CollectionInterface
     */
    public function getNeoDateList();
}
