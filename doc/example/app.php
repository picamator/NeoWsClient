<?php
/**
 * App file, general init for all examples
 */

require_once '../../vendor/autoload.php';

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

$container  = new ContainerBuilder();
$loader     = new YamlFileLoader($container, new FileLocator(__DIR__));
$loader->load('../../config/services.yml');
