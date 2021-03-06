<?php
namespace Picamator\NeoWsClient\Http\Api\Data;

/**
 * Config value object
 */
interface ConfigInterface
{
    /**
     * Get endpoint
     *
     * @return string
     */
    public function getEndPoint();

    /**
     * Get proxy
     *
     * @return string
     */
    public function getProxy();

    /**
     * Get api key
     *
     * @return string
     */
    public function getApiKey();

    /**
     * Get option list
     *
     * @return array
     */
    public function getOptionList();
}
