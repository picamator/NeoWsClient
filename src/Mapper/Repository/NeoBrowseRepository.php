<?php
namespace Picamator\NeoWsClient\Mapper\Repository;

use Picamator\NeoWsClient\Mapper\Api\Builder\SchemaCollectionFactoryInterface;
use Picamator\NeoWsClient\Mapper\Api\RepositoryInterface;
use Picamator\NeoWsClient\Model\Api\Data\Component\CollectionInterface;

/**
 * NeoBrowse Repository
 */
class NeoBrowseRepository implements RepositoryInterface
{
    /**
     * @var array
     */
    private static $schemaConfig = [
        [
            'source' => 'links',
            'destination' => 'link',
            'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Component\NeoBrowse',
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
            'source' => 'page',
            'destination' => 'page',
            'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Component\NeoBrowse',
            'schema' => [
                [
                    'source' => 'size',
                    'destination' => 'size',
                    'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Primitive\Page',
                ], [
                    'source' => 'total_elements',
                    'destination' => 'totalElements',
                    'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Primitive\Page',
                ], [
                    'source' => 'total_pages',
                    'destination' => 'totalPages',
                    'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Primitive\Page',
                ], [
                    'source' => 'number',
                    'destination' => 'number',
                    'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Primitive\Page',
                ],
            ]
        ],
    ];

    /**
     * @var array
     */
    private static $schemaNeoListConfig = [
        'source' => 'near_earth_objects',
        'destination' => 'neoList',
        'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Component\NeoBrowse',
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
            $neoListConfig = self::$schemaNeoListConfig;
            $neoListConfig['schema'] = $this->repository->getSchemaConfig();

            $this->schemaCompose = self::$schemaConfig;
            $this->schemaCompose[] =  $neoListConfig;
        }

        return $this->schemaCompose;
    }
}
