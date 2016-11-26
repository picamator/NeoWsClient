<?php
namespace Picamator\NeoWsClient\Mapper\Api;

use Picamator\NeoWsClient\Exception\InvalidArgumentException;
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
     * @param array $data
     *
     * @return mixed
     *
     * @throws InvalidArgumentException
     */
    public function map(CollectionInterface $schema, array $data);
}
