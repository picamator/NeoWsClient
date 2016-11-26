<?php
namespace Picamator\NeoWsClient\Tests\Integration\Manager;

use Picamator\NeoWsClient\Manager\Api\ManagerInterface;
use Picamator\NeoWsClient\Model\Api\Data\NeoInterface;
use Picamator\NeoWsClient\Request\Data\NeoBrowseRequest;
use Picamator\NeoWsClient\Tests\Integration\BaseTest;

class NeoBrowseManagerTest extends BaseTest
{
    public function testFind()
    {
        $code = 200;
        $limit = 40;
        $remaining = 30;

        // mock http client
        $this->setGuzzleHttpClient($code, $this->getHeaderList($limit, $remaining), 'neo.browse.json');

        /** @var ManagerInterface $manager */
        $manager = $this->container->get('neo_ws_manager_neo_browse_manager');
        $request = new NeoBrowseRequest(['page'=> 1, 'size' => 5]);

        $response = $manager->find($request);
        $this->assertEquals($code, $response->getCode());
        $this->assertEquals($limit, $response->getRateLimit()->getLimit());
        $this->assertEquals($remaining, $response->getRateLimit()->getRemaining());

        /** @var  \Picamator\NeoWsClient\Model\Api\Data\Component\NeoBrowseInterface $data */
        $data = $response->getData();
        $this->assertNotEmpty($data->getLink()->getSelf());
        $this->assertNotEmpty($data->getPage()->getNumber());
        $this->assertNotEmpty($data->getPage()->getSize());
        $this->assertNotEmpty($data->getPage()->getTotalElements());
        $this->assertNotEmpty($data->getPage()->getTotalPages());
        $this->assertNotEmpty($data->getNeoList());

        /** @var NeoInterface $item */
        foreach($data->getNeoList() as $item) {
            $this->assertNeo($item);
        }
    }
}
