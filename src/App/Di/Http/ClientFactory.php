<?php
namespace Picamator\NeoWsClient\App\Di\Http;

use Picamator\NeoWsClient\Http\Api\ClientInterface;
use Picamator\NeoWsClient\Http\Api\Data\ConfigInterface;
use Picamator\NeoWsClient\Model\Api\ObjectManagerInterface;

/**
 * Create HTTP client
 *
 * @codeCoverageIgnore
 */
class ClientFactory
{
    /**
     * @var string
     */
    private static $httpClientName = 'GuzzleHttp\Client';

    /**
     * Create
     *
     * @param ObjectManagerInterface $objectManager
     * @param ConfigInterface $config
     * @param string $className
     *
     * @return ClientInterface
     */
    static public function create(
        ObjectManagerInterface $objectManager,
        ConfigInterface $config,
        $className = 'Picamator\NeoWsClient\Http\Client'
    ) {
        $clientOptionList = $config->getOptionList();
        $clientOptionList['base_uri'] = $config->getEndPoint();

        $proxy = $config->getProxy();
        if(!is_null($proxy)) {
            $clientOptionList['proxy'] = $proxy;
        }

        $client = $objectManager->create(self::$httpClientName, [$clientOptionList]);

        return $objectManager->create($className, [$config, $client]);
    }
}
