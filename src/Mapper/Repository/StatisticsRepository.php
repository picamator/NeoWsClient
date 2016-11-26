<?php
namespace Picamator\NeoWsClient\Mapper\Repository;

use Picamator\NeoWsClient\Mapper\Api\Builder\SchemaCollectionFactoryInterface;
use Picamator\NeoWsClient\Mapper\Api\RepositoryInterface;
use Picamator\NeoWsClient\Model\Api\Data\Component\CollectionInterface;

/**
 * Statistics Repository
 *
 * @codeCoverageIgnore
 */
class StatisticsRepository implements RepositoryInterface
{
    /**
     * @var array
     */
    private static $schemaConfig = [
        [
            'source' => 'near_earth_object_count',
            'destination' => 'neoCount',
            'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Statistics',
        ], [
            'source' => 'close_approach_count',
            'destination' => 'closeApproachCount',
            'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Statistics',
        ], [
            'source' => 'last_updated',
            'destination' => 'lastUpdated',
            'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Statistics',
            'filter' => 'Picamator\NeoWsClient\Mapper\Filter\DateTimeFilter',
        ], [
            'source' => 'source',
            'destination' => 'source',
            'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Statistics',
        ], [
            'source' => 'nasa_jpl_url',
            'destination' => 'nasaJplUrl',
            'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Statistics',
        ],
    ];

    /**
     * @var SchemaCollectionFactoryInterface
     */
    private $schemaFactory;

    /**
     * @var CollectionInterface
     */
    private $schema;

    /**
     * @param SchemaCollectionFactoryInterface $schemaFactory
     */
    public function __construct(SchemaCollectionFactoryInterface $schemaFactory)
    {
        $this->schemaFactory = $schemaFactory;
    }

    /**
     * @inheritDoc
     */
    public function findSchema()
    {
        if (is_null($this->schema)) {
            $this->schema = $this->schemaFactory->create(self::$schemaConfig);
        }

        return $this->schema;
    }

    /**
     * @inheritDoc
     */
    public function getSchemaConfig()
    {
        return self::$schemaConfig;
    }
}
