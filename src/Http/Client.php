<?php
namespace Picamator\NeoWsClient\Http;

use Guzzle\Http\Exception\RequestException;
use Guzzle\Http\Exception\TooManyRedirectsException;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\SeekException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\TransferException;
use GuzzleHttp\Exception\ClientException as GuzzleHttpClientException;
use Picamator\NeoWsClient\Exception\HttpClientException;
use Picamator\NeoWsClient\Http\Api\ClientInterface;
use Picamator\NeoWsClient\Http\Api\Data\ConfigInterface;
use GuzzleHttp\ClientInterface as GuzzleHttpClientInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Client, it's deliberately mark final to encourage composition
 */
final class Client implements ClientInterface
{
    /**
     * @var ConfigInterface
     */
    private $config;

    /**
     * @var GuzzleHttpClientInterface
     */
    private $client;

    /**
     * @var ResponseInterface
     */
    private $response;

    /**
     * @param ConfigInterface $config
     * @param GuzzleHttpClientInterface $client
     */
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
            $this->response = $this->client->request('get', $url);
        } catch (GuzzleHttpClientException $e) {
            $this->response = $e->getResponse();
        } catch(BadResponseException $e) {
            throw new HttpClientException('Processing 3-rd party exception', 0, $e);
        } catch(ConnectException $e) {
            throw new HttpClientException('Processing 3-rd party exception', 0, $e);
        } catch(RequestException $e) {
            throw new HttpClientException('Processing 3-rd party exception', 0, $e);
        } catch(SeekException $e) {
            throw new HttpClientException('Processing 3-rd party exception', 0, $e);
        } catch(ServerException $e) {
            throw new HttpClientException('Processing 3-rd party exception', 0, $e);
        } catch(TooManyRedirectsException $e) {
            throw new HttpClientException('Processing 3-rd party exception', 0, $e);
        } catch(TransferException $e) {
            throw new HttpClientException('Processing 3-rd party exception', 0, $e);
        }

        return $this->response;
    }

    /**
     * @inheritDoc
     *
     * @codeCoverageIgnore
     */
    public function getLastResponse()
    {
        return $this->response;
    }
}
