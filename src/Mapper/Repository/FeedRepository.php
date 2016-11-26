<?php
namespace Picamator\NeoWsClient\Mapper\Repository;

use Picamator\NeoWsClient\Mapper\Api\Builder\SchemaCollectionFactoryInterface;
use Picamator\NeoWsClient\Mapper\Api\RepositoryInterface;
use Picamator\NeoWsClient\Model\Api\Data\Component\CollectionInterface;

/**
 * Feed Repository
 */
class FeedRepository implements RepositoryInterface
{
    /**
     * @var array
     */
    private static $schemaConfig = [
        [
            'source' => 'links',
            'destination' => 'link',
            'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Feed',
            'schema' => [
                [
                    'source' => 'next',
                    'destination' => 'next',
                    'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Primitive\PaginatedLink',
                ], [
                    'source' => 'prev',
                    'destination' => 'prev',
                    'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Primitive\PaginatedLink',
                ], [
                    'source' => 'self',
                    'destination' => 'self',
                    'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Primitive\PaginatedLink',
                ]
            ]
        ], [
            'source' => 'element_count',
            'destination' => 'elementCount',
            'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Feed',
        ],
    ];

    /**
     * @var array
     */
    private static $schemaNeoDateListConfig = [
        'source' => 'near_earth_objects',
        'destination' => 'neoDateList',
        'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Feed',
        'collectionOf' => 'Picamator\NeoWsClient\Model\Api\Data\Component\NeoDateInterface',
        'filter'  => 'Picamator\NeoWsClient\Mapper\Filter\NeoDateFilter',
        'schema' => [
            [
                'source' => 'date',
                'destination' => 'date',
                'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Component\NeoDate',
                'filter' => 'Picamator\NeoWsClient\Mapper\Filter\DateTimeFilter',
            ],
        ]
    ];

    /**
     * @var array
     */
    private static $schemaNeoListConfig = [
        'source' => 'neo',
        'destination' => 'neoList',
        'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Component\NeoDate',
        'collectionOf' => 'Picamator\NeoWsClient\Model\Api\Data\NeoInterface',
    ];

    /**
     * @var SchemaCollectionFactoryInterface
     */
    private $schemaFactory;

    /**
     * @var RepositoryInterface
     */
    private $repository;

    /**
     * @var array
     */
    private $schemaCompose;

    /**
     * @var CollectionInterface
     */
    private $schema;

    /**
     * @param SchemaCollectionFactoryInterface $schemaFactory
     * @param RepositoryInterface $repository
     */
    public function __construct(
        SchemaCollectionFactoryInterface $schemaFactory,
        RepositoryInterface $repository
    ) {
        $this->schemaFactory = $schemaFactory;
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function findSchema()
    {
        if (is_null($this->schema)) {
            $this->schema = $this->schemaFactory->create($this->getSchemaConfig());
        }

        return $this->schema;
    }

    /**
     * @inheritDoc
     */
    public function getSchemaConfig()
    {
        if (is_null($this->schemaCompose)) {
            // neo list
            $neoListConfig = self::$schemaNeoListConfig;
            $neoListConfig['schema'] = $this->repository->getSchemaConfig();

            // neo date list
            $neoDateList = self::$schemaNeoDateListConfig;
            $neoDateList['schema'][] = $neoListConfig;

            $this->schemaCompose = self::$schemaConfig;
            $this->schemaCompose[] =  $neoDateList;
        }

        return $this->schemaCompose;
    }
}
