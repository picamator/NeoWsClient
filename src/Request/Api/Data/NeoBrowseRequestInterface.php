<?php
namespace Picamator\NeoWsClient\Request\Api\Data;

/**
 * Neo Browse Request
 */
interface NeoBrowseRequestInterface extends RequestAwareInterface
{
    /**
     * Get page
     *
     * @return int
     */
    public function getPage();

    /**
     * Get size
     *
     * @return int
     */
    public function getSize();
}
