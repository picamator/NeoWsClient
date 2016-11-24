<?php
namespace Picamator\NeoWsClient\Tests\Unit\Http;

use Guzzle\Http\Exception\CurlException;
use Picamator\NeoWsClient\Http\Client;
use Picamator\NeoWsClient\Tests\Unit\BaseTest;

class ClientTest extends BaseTest
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var \Picamator\NeoWsClient\Http\Api\Data\ConfigInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $configMock;

    /**
     * @var \GuzzleHttp\ClientInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $guzzleHttpClientMock;

    protected function setUp()
    {
        parent::setUp();

        $this->configMock = $this->getMockBuilder('Picamator\NeoWsClient\Http\Api\Data\ConfigInterface')
            ->getMock();

        $this->guzzleHttpClientMock = $this->getMockBuilder('GuzzleHttp\ClientInterface')
            ->getMock();

        $this->client = new Client($this->configMock, $this->guzzleHttpClientMock);
    }

    public function testGetResponse()
    {
        $apiKey = 'my-token';
        $resource = 'neo';
        $paramList = ['detailed' => true];

        // config mock
        $this->configMock->expects($this->once())
            ->method('getApiKey')
            ->willReturn($apiKey);

        // guzzle client mock
        $this->guzzleHttpClientMock->expects($this->once())
            ->method('request')
            ->with($this->equalTo('get'), $this->equalTo('neo?detailed=1&api_key=my-token'));

        $this->client->request($resource, $paramList);
    }

    public function testEmptyParamListGetResponse()
    {
        $apiKey = 'my-token';
        $resource = 'neo';

        // config mock
        $this->configMock->expects($this->once())
            ->method('getApiKey')
            ->willReturn($apiKey);

        // guzzle client mock
        $this->guzzleHttpClientMock->expects($this->once())
            ->method('request')
            ->with($this->equalTo('get'), $this->equalTo('neo?api_key=my-token'));

        $this->client->request($resource);
    }

    /**
     * @expectedException \Picamator\NeoWsClient\Exception\HttpClientException
     */
    public function testFailedGetResponse()
    {
        $apiKey = 'my-token';
        $resource = 'neo';

        // config mock
        $this->configMock->expects($this->once())
            ->method('getApiKey')
            ->willReturn($apiKey);

        // guzzle client mock
        $this->guzzleHttpClientMock->expects($this->once())
            ->method('request')
            ->willThrowException(new CurlException('test'));

        $this->client->request($resource);
    }
}