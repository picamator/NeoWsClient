<?php
namespace Picamator\NeoWsClient\Tests\Unit\Manager;

use Picamator\NeoWsClient\Tests\Unit\BaseTest;

class AbstractManagerTest extends BaseTest
{
    /**
     * @var \Picamator\NeoWsClient\Manager\AbstractManager | \PHPUnit_Framework_MockObject_MockObject
     */
    private $managerMock;

    /**
     * @var \Picamator\NeoWsClient\Http\Api\ClientInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $clientMock;

    /**
     * @var \Picamator\NeoWsClient\Manager\Api\Builder\RateLimitFactoryInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $rateLimitFactoryMock;

    /**
     * @var \Picamator\NeoWsClient\Response\Api\Builder\ResponseFactoryInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $responseFactoryMock;

    /**
     * @var \Picamator\NeoWsClient\Request\Api\Data\RequestAwareInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $requestMock;

    /**
     * @var \Psr\Http\Message\ResponseInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $responseMsgMock;

    /**
     * @var \Picamator\NeoWsClient\Model\Api\Data\Primitive\RateLimitInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $rateLimitMock;

    protected function setUp()
    {
        parent::setUp();

        $this->clientMock = $this->getMockBuilder('Picamator\NeoWsClient\Http\Api\ClientInterface')
            ->getMock();

        $this->rateLimitFactoryMock = $this->getMockBuilder('Picamator\NeoWsClient\Manager\Api\Builder\RateLimitFactoryInterface')
            ->getMock();

        $this->responseFactoryMock = $this->getMockBuilder('Picamator\NeoWsClient\Response\Api\Builder\ResponseFactoryInterface')
            ->getMock();

        $this->requestMock = $this->getMockBuilder('Picamator\NeoWsClient\Request\Api\Data\RequestAwareInterface')
            ->getMock();

        $this->responseMsgMock = $this->getMockBuilder('Psr\Http\Message\ResponseInterface')
            ->getMock();

        $this->rateLimitMock = $this->getMockBuilder('Picamator\NeoWsClient\Model\Api\Data\Primitive\RateLimitInterface')
            ->getMock();

        $this->managerMock = $this->getMockBuilder('Picamator\NeoWsClient\Manager\AbstractManager')
            ->setConstructorArgs([$this->clientMock, $this->rateLimitFactoryMock,  $this->responseFactoryMock])
            ->getMockForAbstractClass();
    }

    public function testSuccessFind()
    {
        $resource = 'test-resource';
        $paramList = [];
        $code = 200;
        $body = '{"test": "test"}';

        // request mock
        $this->requestMock->expects($this->once())
            ->method('getResource')
            ->willReturn($resource);

        $this->requestMock->expects($this->once())
            ->method('getParamList')
            ->willReturn($paramList);

        // response message mock
        $this->responseMsgMock->expects($this->once())
            ->method('getStatusCode')
            ->willReturn($code);

        $this->responseMsgMock->expects($this->once())
            ->method('getBody')
            ->willReturn($body);

        // client mock
        $this->clientMock->expects($this->once())
            ->method('request')
            ->with($this->equalTo($resource), $this->equalTo($paramList))
            ->willReturn($this->responseMsgMock);

        // rate limit factory mock
        $this->rateLimitFactoryMock->expects($this->once())
            ->method('create')
            ->with($this->equalTo($this->responseMsgMock))
            ->willReturn($this->rateLimitMock);

        // manager mock
        $this->managerMock->expects($this->once())
            ->method('getResponseData');

        // response factory mock
        $this->responseFactoryMock->expects($this->once())
            ->method('create')
            ->with($this->equalTo($this->rateLimitMock), $this->equalTo($code), $this->anything());

        $this->managerMock->find($this->requestMock);
    }

    public function testFailCodeFind()
    {
        $resource = 'test-resource';
        $paramList = [];
        $code = 404;

        // request mock
        $this->requestMock->expects($this->once())
            ->method('getResource')
            ->willReturn($resource);

        $this->requestMock->expects($this->once())
            ->method('getParamList')
            ->willReturn($paramList);

        // response message mock
        $this->responseMsgMock->expects($this->once())
            ->method('getStatusCode')
            ->willReturn($code);

        // client mock
        $this->clientMock->expects($this->once())
            ->method('request')
            ->with($this->equalTo($resource), $this->equalTo($paramList))
            ->willReturn($this->responseMsgMock);

        // rate limit factory mock
        $this->rateLimitFactoryMock->expects($this->once())
            ->method('create')
            ->with($this->equalTo($this->responseMsgMock))
            ->willReturn($this->rateLimitMock);

        // response factory mock
        $this->responseFactoryMock->expects($this->once())
            ->method('create')
            ->with($this->equalTo($this->rateLimitMock), $this->equalTo($code), $this->equalTo(new \stdClass()));

        // never
        $this->responseMsgMock->expects($this->never())
            ->method('getBody');
        $this->managerMock->expects($this->never())
            ->method('getResponseData');

        $this->managerMock->find($this->requestMock);
    }

    /**
     * @expectedException \Picamator\NeoWsClient\Exception\RuntimeException
     */
    public function testFailBodyFind()
    {
        $resource = 'test-resource';
        $paramList = [];
        $code = 200;
        $body = '{"test: "test"}';

        // request mock
        $this->requestMock->expects($this->once())
            ->method('getResource')
            ->willReturn($resource);

        $this->requestMock->expects($this->once())
            ->method('getParamList')
            ->willReturn($paramList);

        // response message mock
        $this->responseMsgMock->expects($this->once())
            ->method('getStatusCode')
            ->willReturn($code);

        $this->responseMsgMock->expects($this->exactly(2))
            ->method('getBody')
            ->willReturn($body);

        // client mock
        $this->clientMock->expects($this->once())
            ->method('request')
            ->with($this->equalTo($resource), $this->equalTo($paramList))
            ->willReturn($this->responseMsgMock);

        // rate limit factory mock
        $this->rateLimitFactoryMock->expects($this->once())
            ->method('create')
            ->with($this->equalTo($this->responseMsgMock))
            ->willReturn($this->rateLimitMock);

        // never
        $this->managerMock->expects($this->never())
            ->method('getResponseData');
        $this->responseFactoryMock->expects($this->never())
            ->method('create');

        $this->managerMock->find($this->requestMock);
    }
}
