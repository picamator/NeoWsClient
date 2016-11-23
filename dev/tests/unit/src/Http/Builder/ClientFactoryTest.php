<?php
namespace Picamator\NeoWsClient\Tests\Unit\Http\Builder;

use Picamator\NeoWsClient\Http\Builder\ClientFactory;
use Picamator\NeoWsClient\Tests\Unit\BaseTest;

class ClientFactoryTest extends BaseTest
{
    /**
     * @var ClientFactory
     */
    private $clientFactory;

    /**
     * @var \Picamator\NeoWsClient\Model\Api\ObjectManagerInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $objectManagerMock;

    /**
     * @var \Picamator\NeoWsClient\Http\Api\Data\ConfigInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $configMock;

    protected function setUp()
    {
        parent::setUp();

        $this->objectManagerMock = $this->getMockBuilder('Picamator\NeoWsClient\Model\Api\ObjectManagerInterface')
            ->getMock();

        $this->configMock = $this->getMockBuilder('Picamator\NeoWsClient\Http\Api\Data\ConfigInterface')
            ->getMock();

        $this->clientFactory = new ClientFactory($this->objectManagerMock);
    }

    public function testCreate()
    {
        $endPoint = 'test.com';
        $proxy = '127.0.0.1:8888';

        // config mock
        $this->configMock->expects($this->once())
            ->method('getOptionList')
            ->willReturn([]);

        $this->configMock->expects($this->once())
            ->method('getEndPoint')
            ->willReturn($endPoint);

        $this->configMock->expects($this->once())
            ->method('getProxy')
            ->willReturn($proxy);

        // object manager mock
        $this->objectManagerMock->expects($this->exactly(2))
            ->method('create')
            ->withConsecutive(
                ['GuzzleHttp\Client', [['base_url' => $endPoint, 'proxy' => $proxy]]],
                ['Picamator\NeoWsClient\Http\Client']
            );

        $this->clientFactory->create($this->configMock);
    }
}
