<?php
namespace Picamator\NeoWsClient\Tests\Integration;

use PHPUnit\Framework\TestCase;
use Picamator\NeoWsClient\Http\Client;
use Picamator\NeoWsClient\Model\Api\Data\NeoInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

/**
 * Base to share configuration over all tests
 */
abstract class BaseTest extends TestCase
{
    /**
     * @var ContainerBuilder
     */
    protected $container;

    protected function setUp() 
    {
        parent::setUp();

        $this->container = new ContainerBuilder();
        $loader = new YamlFileLoader( $this->container, new FileLocator(__DIR__));
        $loader->load('../../../../config/services.yml');
    }

    /**
     * Set Guzzle http client
     *
     * @param int $code
     * @param array $headerList
     * @param string $fixture
     */
    protected function setGuzzleHttpClient($code, array $headerList = [], $fixture = null)
    {
        $body = is_null($fixture) ? null : fopen(__DIR__. '/fixture/' . $fixture, 'r');

        $response = new Response($code, $headerList, $body);
        $mock = new MockHandler([$response]);
        $handler = HandlerStack::create($mock);

        $guzzleClient = new GuzzleHttpClient(['handler' => $handler]);
        $client = new Client($this->container->get('neo_ws_http_config'), $guzzleClient);

        $this->container->set('neo_ws_http_client', $client);
    }

    /**
     * Get header list
     *
     * @param int $limit
     * @param int $remaining
     *
     * @return array
     */
    protected function getHeaderList($limit, $remaining)
    {
        return  [
            'X-RateLimit-Limit' => $limit,
            'X-RateLimit-Remaining' => $remaining
        ];
    }

    /**
     * Assert neo
     *
     * @param NeoInterface $neo
     */
    protected function assertNeo(NeoInterface $neo)
    {
        // neo
        $neoSchema = [
            'link',
            'neoReferenceId',
            'name',
            'nasaJplUrl',
            'absoluteMagnitudeH',
            'estimatedDiameter',
            'orbitalData',
        ];

        $neoSchema = $this->getMethodList($neoSchema);
        foreach ($neoSchema as $item) {
            $this->assertNotEmpty($neo->$item(), sprintf('Method "%s" returns empty data', $item));
        }
        $this->assertTrue(is_bool($neo->hasPotentiallyHazardousAsteroid()));

        // close approach
        $closeApproachSchema = [
            'closeApproachDate',
            'epochDateCloseApproach',
            'relativeVelocity',
            'missDistance',
            'orbitingBody',
        ];

        $closeApproachSchema = $this->getMethodList($closeApproachSchema);
        foreach($neo->getCloseApproachData() as $item) {
            foreach ($closeApproachSchema as $schemaItem) {
                $this->assertNotEmpty($item->$schemaItem(), sprintf('Method "%s" returns empty data', $schemaItem));
            }
        }

        // orbital data
        $orbitSchema = [
            'orbitId',
            'orbitDeterminationDate',
            'orbitUncertainty',
            'minimumOrbitIntersection',
            'jupiterTisserandInvariant',
            'epochOsculation',
            'eccentricity',
            'semiMajorAxis',
            'inclination',
            'ascendingNodeLongitude',
            'orbitalPeriod',
            'perihelionDistance',
            'perihelionArgument',
            'aphelionDistance',
            'perihelionTime',
            'meanAnomaly',
            'meanMotion',
            'equinox',
        ];
        $orbitSchema = $this->getMethodList($orbitSchema);
        foreach ($orbitSchema as $item) {
            $this->assertNotNull($neo->getOrbitalData()->$item(), sprintf('Method "%s" returns empty data', $item));
        }
    }

    /**
     * Get method list
     *
     * @param array $schemaList
     *
     * @return array
     */
    protected function getMethodList(array $schemaList)
    {
        return array_map(function($item) {
            return 'get' . ucfirst($item);
        }, $schemaList);
    }
}
