<?php
namespace Picamator\NeoWsClient\Response\Api\Data\Primitive;

/**
 * Paginated link value object
 */
interface PaginatedLinkInterface
{
    /**
     * Get next
     *
     * @return string | null
     */
    public function getNext();

    /**
     * Get prev
     *
     * @return string | null
     */
    public function getPrev();

    /**
     * Get self
     *
     * @return string
     */
    public function getSelf();
}
