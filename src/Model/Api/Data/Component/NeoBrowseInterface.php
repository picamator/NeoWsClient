<?php
namespace Picamator\NeoWsClient\Model\Api\Data\Component;

use Picamator\NeoWsClient\Model\Api\Data\Component\CollectionInterface;
use Picamator\NeoWsClient\Model\Api\Data\Primitive\PageInterface;
use Picamator\NeoWsClient\Model\Api\Data\Primitive\PaginatedLinkInterface;

/**
 * Neo browse value object
 */
interface NeoBrowseInterface
{
    /**
     * Get link
     *
     * @return PaginatedLinkInterface
     */
    public function getLink();

    /**
     * Get page
     *
     * @return PageInterface
     */
    public function getPage();

    /**
     * Get collection of Neo's objects
     *
     * @return CollectionInterface
     */
    public function getNeoList();
}
