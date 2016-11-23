<?php
namespace Picamator\NeoWsClient\Request\Api\Data;

/**
 * Feed Today Request
 */
interface FeedTodayRequestInterface extends RequestAwareInterface
{
    /**
     * Get detailed
     *
     * @return bool
     */
    public function getDetailed();
}
