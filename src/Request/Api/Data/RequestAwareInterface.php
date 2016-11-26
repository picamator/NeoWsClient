<?php
namespace Picamator\NeoWsClient\Request\Api\Data;

/**
 * Essential Request's methods
 */
interface RequestAwareInterface
{
    /**
     * Get parameter list
     *
     * @return array
     */
    public function getParamList();

    /**
     * Get resource
     *
     * @return string
     */
    public function getResource();
}
