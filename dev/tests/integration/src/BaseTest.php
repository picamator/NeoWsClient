<?php
namespace Picamator\NeoWsClient\Tests\Integration;

use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

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

        $this->container  = new ContainerBuilder();
        $loader     = new YamlFileLoader( $this->container, new FileLocator(__DIR__));
        $loader->load('../../../../config/services.yml');
    }
}
