<?php
namespace Picamator\NeoWsClient\Mapper\Api\Data;

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
     * Get interface that are going to be present inside collection
     *
     * @return string
     */
    public function getCollectionOf();

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
