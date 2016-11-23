<?php
namespace Picamator\NeoWsClient\Http\Api\Builder;

use Picamator\NeoWsClient\Http\Api\ClientInterface;
use Picamator\NeoWsClient\Http\Api\Data\ConfigInterface;

/**
 * Create Client
 */
interface ClientFactoryInterface
{
    /**
     * Create
     *
     * @param ConfigInterface $config
     *
     * @return ClientInterface
     */
    public function create(ConfigInterface $config);
}
