<?php
namespace Picamator\NeoWsClient\Mapper\Api;

use Picamator\NeoWsClient\Model\Api\Data\Component\CollectionInterface;

/**
 * Mapper Repository
 */
interface RepositoryInterface
{
    /**
     * Find schema
     *
     * @return CollectionInterface
     */
    public function findSchema();
}
