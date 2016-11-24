<?php
namespace Picamator\NeoWsClient\Mapper;

use Picamator\NeoWsClient\Exception\InvalidArgumentException;
use Picamator\NeoWsClient\Mapper\Api\Data\SchemaInterface;
use Picamator\NeoWsClient\Mapper\Api\MapperInterface;
use Picamator\NeoWsClient\Model\Api\Data\Component\CollectionInterface;
use Picamator\NeoWsClient\Model\Api\ObjectManagerInterface;

/**
 * Map between api response and model's data
 */
class Mapper implements MapperInterface
{
    /**
     * @var string
     */
    private static $collectionType = 'Picamator\NeoWsClient\Mapper\Api\Data\SchemaInterface';

    /**
     * @var ObjectManagerInterface
     */
    private $objectManager;

    /**
     * @param ObjectManagerInterface $objectManager
     */
    public function __construct(ObjectManagerInterface $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * @inheritDoc
     */
    public function map(CollectionInterface $schema, array $data)
    {
        // validate schema collection type
        if ($schema->getType() !== self::$collectionType) {
            throw new InvalidArgumentException(
                sprintf('Can not map data. Wrong collection type. It is expected collection of "%s" objects but got "%s".',
                    self::$collectionType, $schema->getType())
            );
        }

        // validate schema non emptiness
        if ($schema->count() === 0) {
            throw new InvalidArgumentException('Can not map data. Empty schema container.');
        }

        return $this->mapRecursive($schema, $data);
    }

    /**
     * Map recursive
     *
     * @param CollectionInterface | array  $schema
     * @param array $data
     * @param array | null $mapData
     *
     * @return mixed
     */
    private function mapRecursive($schema, array $data, array $mapData = null)
    {
        $mapData = $mapData ? : [];

        /** @var SchemaInterface $item */
        foreach ($schema as $item) {
            if (!array_key_exists($item->getSource(), $data)) {
                continue;
            }

            $sourceData = $data[$item->getSource()];
            // apply filter
            $filter = $item->getFilter();
            $sourceData = $filter ? $filter->filter($sourceData) : $sourceData;

            // apply sub schema
            $schema = $item->getSchema();
            $mapData[$item->getDestination()] = $schema ? $this->mapRecursive([$schema], $sourceData) : $sourceData;
        }

        return $this->objectManager->create($item->getDestinationContainer(), [$mapData]);
    }
}
