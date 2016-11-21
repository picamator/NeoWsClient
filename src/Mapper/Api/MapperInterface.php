<?php
namespace Picamator\NeoWsClient\Mapper\Api;

use Picamator\NeoWsClient\Model\Api\Data\Component\CollectionInterface;

/**
 * Map between api response and model's data
 */
interface MapperInterface
{
    /**
     * Map
     *
     * @param CollectionInterface $schema
     *
     * @return mixed
     */
    public function map(CollectionInterface $schema);
}
