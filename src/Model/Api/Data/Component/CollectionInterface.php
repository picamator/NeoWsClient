<?php
namespace Picamator\NeoWsClient\Model\Api\Data\Component;

/**
 * Collection
 */
interface CollectionInterface extends \IteratorAggregate, \Countable
{
    /**
     * Get data
     *
     * @return array
     */
    public function getData();

    /**
     * Get type
     *
     * @return string
     */
    public function getType();
}
