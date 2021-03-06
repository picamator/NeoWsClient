<?php
namespace Picamator\NeoWsClient\Tests\Unit\Manager;

use Picamator\NeoWsClient\Manager\Manager;
use Picamator\NeoWsClient\Tests\Unit\BaseTest;

class ManagerTest extends BaseTest
{
    /**
     * @var Manager
     */
    private $manager;

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
     * @var \Picamator\NeoWsClient\Mapper\Api\RepositoryInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $repositoryMock;

    /**
     * @var \Picamator\NeoWsClient\Mapper\Api\MapperInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $mapperMock;

    /**
     * @var \Picamator\NeoWsClient\Model\Api\Data\Primitive\RateLimitInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $rateLimitMock;

    /**
     * @var \Picamator\NeoWsClient\Model\Data\Component\Collection | \PHPUnit_Framework_MockObject_MockObject
     */
    private $collectionMock;

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

        $this->repositoryMock = $this->getMockBuilder('Picamator\NeoWsClient\Mapper\Api\RepositoryInterface')
            ->getMock();

        $this->mapperMock = $this->getMockBuilder('Picamator\NeoWsClient\Mapper\Api\MapperInterface')
            ->getMock();

        $this->rateLimitMock = $this->getMockBuilder('Picamator\NeoWsClient\Model\Api\Data\Primitive\RateLimitInterface')
            ->getMock();

        $this->collectionMock = $this->getMockBuilder('Picamator\NeoWsClient\Model\Api\Data\Component\CollectionInterface')
            ->getMock();

        $this->manager = new Manager(
            $this->clientMock,
            $this->rateLimitFactoryMock,
            $this->responseFactoryMock,
            $this->mapperMock,
            $this->repositoryMock
        );
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

        // repository mock
        $this->repositoryMock->expects($this->once())
            ->method('findSchema')
            ->willReturn($this->collectionMock);

        // mapper mock
        $this->mapperMock->expects($this->once())
            ->method('map')
            ->with($this->equalTo($this->collectionMock), $this->equalTo(json_decode($body, true)));

        // response factory mock
        $this->responseFactoryMock->expects($this->once())
            ->method('create')
            ->with($this->equalTo($this->rateLimitMock), $this->equalTo($code), $this->anything());

        $this->manager->find($this->requestMock);
    }

    public function testFailCodeFind()
    {
        $resource = 'test-resource';
        $paramList = [];
        $code = 404;
        $msg = 'Error';

        // request mock
        $this->requestMock->expects($this->once())
            ->method('getResource')
            ->willReturn($resource);

        $this->requestMock->expects($this->once())
            ->method('getParamList')
            ->willReturn($paramList);

        // stream mock
        $streamMock = $this->getMockBuilder('Psr\Http\Message\StreamInterface')
            ->getMock();

        $streamMock->expects($this->once())
            ->method('getContents')
            ->willReturn($msg);

        // response message mock
        $this->responseMsgMock->expects($this->once())
            ->method('getStatusCode')
            ->willReturn($code);

        $this->responseMsgMock->expects($this->once())
            ->method('getBody')
            ->willReturn($streamMock);

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
            ->with($this->equalTo($this->rateLimitMock), $this->equalTo($code), $this->equalTo((object) $msg));

        // never
        $this->repositoryMock->expects($this->never())
            ->method('findSchema');
        $this->mapperMock->expects($this->never())
            ->method('map');

        $this->manager->find($this->requestMock);
    }

    /**
     * @expectedException \Picamator\NeoWsClient\Exception\ManagerException
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
        $this->responseFactoryMock->expects($this->never())
            ->method('create');
        $this->repositoryMock->expects($this->never())
            ->method('findSchema');
        $this->mapperMock->expects($this->never())
            ->method('map');

        $this->manager->find($this->requestMock);
    }
}
