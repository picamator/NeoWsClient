<?php
namespace Picamator\NeoWsClient\Mapper\Repository;

use Picamator\NeoWsClient\Mapper\Api\Builder\SchemaCollectionFactoryInterface;
use Picamator\NeoWsClient\Mapper\Api\RepositoryInterface;
use Picamator\NeoWsClient\Model\Api\Data\Component\CollectionInterface;

/**
 * Neo Repository
 *
 * @codeCoverageIgnore
 */
class NeoRepository implements RepositoryInterface
{
    /**
     * @var array
     */
    private static $schemaConfig = [
        [
            'source' => 'links',
            'destination' => 'link',
            'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Neo',
            'schema' => [
                [
                    'source' => 'self',
                    'destination' => 'self',
                    'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Primitive\Link',
                ]
            ]
        ], [
            'source' => 'neo_reference_id',
            'destination' => 'neoReferenceId',
            'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Neo',
        ], [
            'source' => 'name',
            'destination' => 'name',
            'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Neo',
        ], [
            'source' => 'nasa_jpl_url',
            'destination' => 'nasaJplUrl',
            'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Neo',
        ], [
            'source' => 'absolute_magnitude_h',
            'destination' => 'absoluteMagnitudeH',
            'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Neo',
        ], [
            'source' => 'estimated_diameter',
            'destination' => 'estimatedDiameter',
            'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Neo',
            'schema' => [
                [
                    'source' => 'kilometers',
                    'destination' => 'kilometers',
                    'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Component\EstimateDiameter',
                    'schema' => [
                        [
                            'source' => 'estimated_diameter_min',
                            'destination' => 'estimatedDiameterMin',
                            'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Primitive\Diameter',
                        ], [
                            'source' => 'estimated_diameter_max',
                            'destination' => 'estimatedDiameterMax',
                            'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Primitive\Diameter',
                        ]
                    ],
                ], [
                    'source' => 'meters',
                    'destination' => 'meters',
                    'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Component\EstimateDiameter',
                    'schema' => [
                        [
                            'source' => 'estimated_diameter_min',
                            'destination' => 'estimatedDiameterMin',
                            'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Primitive\Diameter',
                        ], [
                            'source' => 'estimated_diameter_max',
                            'destination' => 'estimatedDiameterMax',
                            'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Primitive\Diameter',
                        ]
                    ],
                ], [
                    'source' => 'miles',
                    'destination' => 'miles',
                    'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Component\EstimateDiameter',
                    'schema' => [
                        [
                            'source' => 'estimated_diameter_min',
                            'destination' => 'estimatedDiameterMin',
                            'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Primitive\Diameter',
                        ], [
                            'source' => 'estimated_diameter_max',
                            'destination' => 'estimatedDiameterMax',
                            'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Primitive\Diameter',
                        ]
                    ],
                ], [
                    'source' => 'feet',
                    'destination' => 'feet',
                    'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Component\EstimateDiameter',
                    'schema' => [
                        [
                            'source' => 'estimated_diameter_min',
                            'destination' => 'estimatedDiameterMin',
                            'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Primitive\Diameter',
                        ], [
                            'source' => 'estimated_diameter_max',
                            'destination' => 'estimatedDiameterMax',
                            'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Primitive\Diameter',
                        ]
                    ],
                ]
            ]
        ], [
            'source' => 'is_potentially_hazardous_asteroid',
            'destination' => 'potentiallyHazardousAsteroid',
            'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Neo',
        ],  [
            'source' => 'close_approach_data',
            'destination' => 'closeApproachData',
            'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Neo',
            'collectionOf' => 'Picamator\NeoWsClient\Model\Api\Data\Component\CloseApproachInterface',
            'schema' => [
                [
                    'source' => 'close_approach_date',
                    'destination' => 'closeApproachDate',
                    'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Component\CloseApproach',
                    'filter' => 'Picamator\NeoWsClient\Mapper\Filter\DateTimeFilter',
                ], [
                    'source' => 'epoch_date_close_approach',
                    'destination' => 'epochDateCloseApproach',
                    'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Component\CloseApproach',
                ], [
                    'source' => 'relative_velocity',
                    'destination' => 'relativeVelocity',
                    'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Component\CloseApproach',
                    'schema' => [
                        [
                            'source' => 'kilometers_per_second',
                            'destination' => 'kilometersPerSecond',
                            'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Primitive\Velocity',
                        ], [
                            'source' => 'kilometers_per_hour',
                            'destination' => 'kilometersPerHour',
                            'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Primitive\Velocity',
                        ],  [
                            'source' => 'miles_per_hour',
                            'destination' => 'milesPerHour',
                            'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Primitive\Velocity',
                        ]
                    ]
                ], [
                    'source' => 'miss_distance',
                    'destination' => 'missDistance',
                    'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Component\CloseApproach',
                    'schema' => [
                        [
                            'source' => 'astronomical',
                            'destination' => 'astronomical',
                            'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Primitive\Distance',
                        ], [
                            'source' => 'lunar',
                            'destination' => 'lunar',
                            'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Primitive\Distance',
                        ], [
                            'source' => 'kilometers',
                            'destination' => 'kilometers',
                            'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Primitive\Distance',
                        ], [
                            'source' => 'miles',
                            'destination' => 'miles',
                            'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Primitive\Distance',
                        ]
                    ]
                ], [
                    'source' => 'orbiting_body',
                    'destination' => 'orbitingBody',
                    'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Component\CloseApproach',
                ]
            ]
        ], [
            'source' => 'orbital_data',
            'destination' => 'orbitalData',
            'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Neo',
            'schema' => [
                [
                    'source' => 'orbit_id',
                    'destination' => 'orbitId',
                    'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Primitive\Orbit',
                ], [
                    'source' => 'orbit_determination_date',
                    'destination' => 'orbitDeterminationDate',
                    'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Primitive\Orbit',
                    'filter' => 'Picamator\NeoWsClient\Mapper\Filter\DateTimeFilter',
                ], [
                    'source' => 'orbit_uncertainty',
                    'destination' => 'orbitUncertainty',
                    'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Primitive\Orbit',
                ], [
                    'source' => 'minimum_orbit_intersection',
                    'destination' => 'minimumOrbitIntersection',
                    'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Primitive\Orbit',
                ], [
                    'source' => 'jupiter_tisserand_invariant',
                    'destination' => 'jupiterTisserandInvariant',
                    'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Primitive\Orbit',
                ], [
                    'source' => 'epoch_osculation',
                    'destination' => 'epochOsculation',
                    'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Primitive\Orbit',
                ], [
                    'source' => 'eccentricity',
                    'destination' => 'eccentricity',
                    'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Primitive\Orbit',
                ], [
                    'source' => 'semi_major_axis',
                    'destination' => 'semiMajorAxis',
                    'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Primitive\Orbit',
                ], [
                    'source' => 'inclination',
                    'destination' => 'inclination',
                    'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Primitive\Orbit',
                ], [
                    'source' => 'ascending_node_longitude',
                    'destination' => 'ascendingNodeLongitude',
                    'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Primitive\Orbit',
                ], [
                    'source' => 'orbital_period',
                    'destination' => 'orbitalPeriod',
                    'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Primitive\Orbit',
                ], [
                    'source' => 'perihelion_distance',
                    'destination' => 'perihelionDistance',
                    'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Primitive\Orbit',
                ], [
                    'source' => 'perihelion_argument',
                    'destination' => 'perihelionArgument',
                    'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Primitive\Orbit',
                ], [
                    'source' => 'aphelion_distance',
                    'destination' => 'aphelionDistance',
                    'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Primitive\Orbit',
                ], [
                    'source' => 'perihelion_time',
                    'destination' => 'perihelionTime',
                    'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Primitive\Orbit',
                ], [
                    'source' => 'mean_anomaly',
                    'destination' => 'meanAnomaly',
                    'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Primitive\Orbit',
                ], [
                    'source' => 'mean_motion',
                    'destination' => 'meanMotion',
                    'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Primitive\Orbit',
                ], [
                    'source' => 'equinox',
                    'destination' => 'equinox',
                    'destinationContainer' => 'Picamator\NeoWsClient\Model\Data\Primitive\Orbit',
                ],
            ]
        ]
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
