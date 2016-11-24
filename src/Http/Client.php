<?php
namespace Picamator\NeoWsClient\Http;

use Picamator\NeoWsClient\Exception\HttpClientException;
use Picamator\NeoWsClient\Http\Api\ClientInterface;
use Picamator\NeoWsClient\Http\Api\Data\ConfigInterface;
use GuzzleHttp\ClientInterface as GuzzleHttpClientInterface;

/**
 * Client
 */
class Client implements ClientInterface
{
    /**
     * @var ConfigInterface
     */
    private $config;

    /**
     * @var GuzzleHttpClientInterface
     */
    private $client;

    public function __construct(
        ConfigInterface $config,
        GuzzleHttpClientInterface $client
    ) {
        $this->config = $config;
        $this->client = $client;
    }

    /**
     * @inheritDoc
     */
    public function request($resource, array $paramList = [])
    {
        // override token
        $paramList['api_key'] = $this->config->getApiKey();

        // build url
        $url = $resource;
        $url .= empty($paramList) ? '' : '?' . http_build_query($paramList);

        // catch 3-rd party exception
        try {
            /** @var \Psr\Http\Message\ResponseInterface $response */
            $response = $this->client->request('get', $url);

        } catch (\Exception $e) {
            throw new HttpClientException('Processing 3-rd party exception', 0, $e);
        }

        return $response;
    }
}
