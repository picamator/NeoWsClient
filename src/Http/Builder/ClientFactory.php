<?php
namespace Picamator\NeoWsClient\Http\Builder;

use Picamator\NeoWsClient\Http\Api\Builder\ClientFactoryInterface;
use Picamator\NeoWsClient\Http\Api\Data\ConfigInterface;
use Picamator\NeoWsClient\Model\Api\ObjectManagerInterface;

/**
 * Create Client
 */
class ClientFactory implements ClientFactoryInterface
{
    /**
     * @var string
     */
    private static $httpClientName = 'GuzzleHttp\Client';

    /**
     * @var ObjectManagerInterface
     */
    private $objectManager;

    /**
     * @var string
     */
    private $className;

    /**
     * @param ObjectManagerInterface $objectManager
     * @param string $className
     */
    public function __construct(
        ObjectManagerInterface $objectManager,
        $className = 'Picamator\NeoWsClient\Http\Client'
    ) {
        $this->objectManager = $objectManager;
        $this->className = $className;
    }

    /**
     * @inheritDoc
     */
    public function create(ConfigInterface $config)
    {
        $clientOptionList = $config->getOptionList();
        $clientOptionList['base_url'] = $config->getEndPoint();

        $proxy = $config->getProxy();
        if(!is_null($proxy)) {
            $clientOptionList['proxy'] = $proxy;
        }

        $client = $this->objectManager->create(self::$httpClientName, [$clientOptionList]);

        return $this->objectManager->create($this->className, [$config, $client]);
    }
}
