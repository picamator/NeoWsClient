<?php
namespace Picamator\NeoWsClient\Mapper\Api\Builder;

use Picamator\NeoWsClient\Model\Api\Data\Component\CollectionInterface;

/**
 * Create Collection fo schema's objects
 */
interface SchemaCollectionFactoryInterface
{
    /**
     * Create
     *
     * @param array $data
     *
     * @return CollectionInterface
     */
    public function create(array $data);
}
