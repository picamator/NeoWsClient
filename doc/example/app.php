<?php
namespace Picamator\NeoWsClient\Example;

/**
 * App file, general init for all examples
 */

require_once __DIR__ . '/../../vendor/autoload.php';

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

if(!isset($container)) {
    $container  = new ContainerBuilder();
    $loader     = new YamlFileLoader($container, new FileLocator(__DIR__));
    $loader->load('../../config/services.yml');
}
