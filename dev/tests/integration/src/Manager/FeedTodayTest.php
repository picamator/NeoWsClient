<?php
namespace Picamator\NeoWsClient\Tests\Integration\Manager;

use Picamator\NeoWsClient\Manager\Api\ManagerInterface;
use Picamator\NeoWsClient\Request\Data\FeedTodayRequest;
use Picamator\NeoWsClient\Tests\Integration\BaseTest;

class FeedTodayTest extends BaseTest
{
    public function testDetailedFind()
    {
        $code = 200;
        $limit = 40;
        $remaining = 30;

        // mock http client
        $this->setGuzzleHttpClient($code, $this->getHeaderList($limit, $remaining), 'feed.today.detailed.json');

        /** @var ManagerInterface $manager */
        $manager = $this->container->get('neo_ws_manager_feed_manager');
        $request = new FeedTodayRequest();

        $response = $manager->find($request);
        $this->assertEquals($code, $response->getCode());
        $this->assertEquals($limit, $response->getRateLimit()->getLimit());
        $this->assertEquals($remaining, $response->getRateLimit()->getRemaining());

        /** @var  \Picamator\NeoWsClient\Model\Api\Data\FeedInterface $data */
        $data = $response->getData();
        $this->assertNotEmpty($data->getElementCount());

        /** @var \Picamator\NeoWsClient\Model\Data\Component\NeoDate $item */
        foreach($data->getNeoDateList() as $item) {
            $this->assertNotEmpty($item->getDate(), 'Method "getDate" returns empty data');

            /** @var \Picamator\NeoWsClient\Model\Data\Neo $neoItem */
            foreach($item->getNeoList() as $neoItem) {
                $this->assertNeo($neoItem);
            }
        }
    }
}
