<?php
namespace Picamator\NeoWsClient\Mapper\Builder;

use Picamator\NeoWsClient\Mapper\Api\Builder\SchemaCollectionFactoryInterface;
use Picamator\NeoWsClient\Mapper\Api\Data\Component\SchemaInterface;
use Picamator\NeoWsClient\Mapper\Api\FilterInterface;
use Picamator\NeoWsClient\Model\Api\ObjectManagerInterface;

/**
 * Create Collection fo schema's objects
 */
class SchemaCollectionFactory implements SchemaCollectionFactoryInterface
{
    /**
     * @var string
     */
    private static $collectionType = 'Picamator\NeoWsClient\Mapper\Api\Data\Component\SchemaInterface;';

    /**
     * @var ObjectManagerInterface
     */
    private $objectManager;

    /**
     * @var string
     */
    private $className;

    /**
     * @var string
     */
    private $schemaName;

    /**
     * Shared filter container
     *
     * @var array
     */
    private $filterContainer = [];

    /**
     * @param ObjectManagerInterface $objectManager
     * @param string $className
     * @param string $schemaName
     */
    public function __construct(
        ObjectManagerInterface $objectManager,
        $className = 'Picamator\NeoWsClient\Model\Data\Component\Collection',
        $schemaName = 'Picamator\NeoWsClient\Mapper\Data\Component\Schema'
    ) {
        $this->objectManager = $objectManager;
        $this->className = $className;
        $this->schemaName = $schemaName;
    }

    /**
     * @inheritDoc
     */
    public function create(array $data)
    {
        $collectionData = [];
        foreach ($data as $item) {
            $collectionData[] = $this->createSchema($item);
        }

        return $this->objectManager->create($this->className, ['data' => $collectionData, 'type' => self::$collectionType]);
    }

    /**
     * Create schema
     *
     * @param array $data
     *
     * @return SchemaInterface
     */
    private function createSchema(array $data)
    {
        // filter
        $filter = null;
        if(!empty($data['filter'])) {
            $filter = $this->createFilter($data['filter']);
            unset($data['filter']);
        }

        // schema
        $schema = null;
        if(!empty($data['schema'])) {
            $schema = $this->createSchema($data['schema']);
            unset($data['schema']);
        }

        return $this->objectManager->create($this->schemaName, [$data, $filter, $schema]);
    }

    /**
     * Create filter
     *
     * @param string $filterName
     *
     * @return FilterInterface
     */
    private function createFilter($filterName)
    {
        $key = str_replace('\\', '_', $filterName);
        if (!array_key_exists($key, $this->filterContainer)) {
            $this->filterContainer[$key] = $this->objectManager->create($filterName);
        }

        return $this->filterContainer[$key];
    }
}
