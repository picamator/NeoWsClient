<?php
namespace Picamator\NeoWsClient\Mapper\Api\Data\Component;
use Picamator\NeoWsClient\Mapper\Api\FilterInterface;

/**
 * Schema value object
 */
interface SchemaInterface
{
    /**
     * Get source
     *
     * @return string
     */
    public function getSource();

    /**
     * Get destination
     *
     * @return string
     */
    public function getDestination();

    /**
     * Get destination container
     *
     * @return string
     */
    public function getDestinationContainer();

    /**
     * Get filter
     *
     * @return FilterInterface | null
     */
    public function getFilter();

    /**
     * Get schema
     *
     * @return SchemaInterface | null
     */
    public function getSchema();
}
