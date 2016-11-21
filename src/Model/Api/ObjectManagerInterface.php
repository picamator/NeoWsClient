<?php
namespace Picamator\NeoWsClient\Model\Api;

use Picamator\NeoWsClient\Exception\RuntimeException;

/**
 * Creates objects, the main usage inside factories.
 *
 * All objects are unshared, for shared objects please use DI service libraries
 */
interface ObjectManagerInterface
{
    /**
     * Create objects.
     *
     * @param string $className
     * @param array  $arguments
     *
     * @throws RuntimeException
     *
     * @return mixed
     */
    public function create($className, array $arguments = []);
}
