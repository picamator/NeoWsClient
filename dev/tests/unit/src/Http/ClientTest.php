<?php
namespace Picamator\NeoWsClient\Tests\Unit\Http;

use Guzzle\Http\Exception\RequestException;
use Guzzle\Http\Exception\TooManyRedirectsException;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\SeekException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\TransferException;
use GuzzleHttp\Exception\ClientException as GuzzleHttpClientException;
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

    public function testRequest()
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

    public function testEmptyParamListRequest()
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

    public function testExceptionClientRequest()
    {
        $msg = 'test';
        $resource = 'neo';

        // request mock
        $requestMock = $this->getMockBuilder('Psr\Http\Message\RequestInterface')
            ->getMock();

        // response mock
        $responseMock = $this->getMockBuilder('Psr\Http\Message\ResponseInterface')
            ->getMock();

        $exception = new GuzzleHttpClientException($msg, $requestMock, $responseMock);


        // guzzle client mock
        $this->guzzleHttpClientMock->expects($this->once())
            ->method('request')
            ->willThrowException($exception);

        $this->client->request($resource);
    }

    /**
     * @dataProvider providerExceptionRequest
     * @expectedException \Picamator\NeoWsClient\Exception\HttpClientException
     *
     * @param \Exception $exception
     */
    public function testExceptionRequest(\Exception $exception)
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
            ->willThrowException($exception);

        $this->client->request($resource);
    }

    public function providerExceptionRequest()
    {
        $requestMock = $this->getMockBuilder('Psr\Http\Message\RequestInterface')
            ->getMock();

        $streamMock = $this->getMockBuilder('Psr\Http\Message\StreamInterface')
            ->getMock();

        return [
            [new BadResponseException('test', $requestMock)],
            [new ConnectException('test', $requestMock)],
            [new RequestException('test')],
            [new SeekException($streamMock)],
            [new ServerException('test', $requestMock)],
            [new TooManyRedirectsException('test')],
            [new TransferException('test')],
        ];
    }
}
