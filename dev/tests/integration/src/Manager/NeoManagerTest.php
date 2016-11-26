<?php
namespace Picamator\NeoWsClient\Tests\Integration\Manager;

use Picamator\NeoWsClient\Manager\Api\ManagerInterface;
use Picamator\NeoWsClient\Request\Data\NeoRequest;
use Picamator\NeoWsClient\Tests\Integration\BaseTest;

class NeoManagerTest extends BaseTest
{
    public function testFind()
    {
        $code = 200;
        $limit = 40;
        $remaining = 30;

        // mock http client
        $this->setGuzzleHttpClient($code, $this->getHeaderList($limit, $remaining), 'neo.json');

        /** @var ManagerInterface $manager */
        $manager = $this->container->get('neo_ws_manager_neo_manager');
        $request = new NeoRequest(['asteroidId' => '3729835']);

        $response = $manager->find($request);
        $this->assertEquals($code, $response->getCode());
        $this->assertEquals($limit, $response->getRateLimit()->getLimit());
        $this->assertEquals($remaining, $response->getRateLimit()->getRemaining());

        $this->assertNeo($response->getData());
    }
}
