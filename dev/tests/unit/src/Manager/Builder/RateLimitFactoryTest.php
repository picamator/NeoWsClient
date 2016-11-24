<?php
namespace Picamator\NeoWsClient\Tests\Unit\Manager\Builder;

use Picamator\NeoWsClient\Manager\Builder\RateLimitFactory;
use Picamator\NeoWsClient\Tests\Unit\BaseTest;

class RateLimitFactoryTest extends BaseTest
{
    /**
     * @var RateLimitFactory
     */
    private $factory;

    /**
     * @var \Picamator\NeoWsClient\Model\Api\ObjectManagerInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $objectManagerMock;

    /**
     * @var \Psr\Http\Message\ResponseInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $responseMock;

    protected function setUp()
    {
        parent::setUp();

        $this->objectManagerMock = $this->getMockBuilder('Picamator\NeoWsClient\Model\Api\ObjectManagerInterface')
            ->getMock();

        $this->responseMock = $this->getMockBuilder('Psr\Http\Message\ResponseInterface')
            ->getMock();

        $this->factory = new RateLimitFactory($this->objectManagerMock);
    }

    public function testCreate()
    {
        $limit = '20';
        $remaining = '10';

        // response mock
        $this->responseMock->expects($this->exactly(2))
            ->method('getHeader')
            ->withConsecutive(
                ['x-ratelimit-limit'],
                ['x-ratelimit-remaining']
            )->willReturnOnConsecutiveCalls([$limit], [$remaining]);

        // object manager mock
        $this->objectManagerMock->expects($this->once())
            ->method('create')
            ->with($this->equalTo('Picamator\NeoWsClient\Response\Data\Primitive\RateLimit'), [[
                'limit' => (int) $limit,
                'remaining' => (int) $remaining,
            ]]);

        $this->factory->create($this->responseMock);
    }
}
