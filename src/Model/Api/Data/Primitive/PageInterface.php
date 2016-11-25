<?php
namespace Picamator\NeoWsClient\Model\Api\Data\Primitive;

/**
 * Page value object
 */
interface PageInterface
{
    /**
     * Get size
     *
     * @return int
     */
    public function getSize();

    /**
     * Get total elements
     *
     * @return int
     */
    public function getTotalElements();

    /**
     * Get total pages
     *
     * @return int
     */
    public function getTotalPages();

    /**
     * Get number
     *
     * @return int
     */
    public function getNumber();
}
