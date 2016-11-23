<?php
namespace Picamator\NeoWsClient\Request\Api\Data;

/**
 * Feed Request
 */
interface FeedRequestInterface extends RequestAwareInterface
{
    /**
     * Get start date
     *
     * @return string
     */
    public function getStartDate();

    /**
     * Get end date
     *
     * @return string
     */
    public function getEndDate();

    /**
     * Get detailed
     *
     * @return bool
     */
    public function getDetailed();
}
