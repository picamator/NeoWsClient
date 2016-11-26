<?php
namespace Picamator\NeoWsClient\Tests\Integration\Manager;

use Picamator\NeoWsClient\Manager\Api\ManagerInterface;
use Picamator\NeoWsClient\Request\Data\StatisticsRequest;
use Picamator\NeoWsClient\Tests\Integration\BaseTest;

class StatisticsManagerTest extends BaseTest
{
    public function testFind()
    {
        $code = 200;
        $limit = 40;
        $remaining = 30;

        // mock http client
        $this->setGuzzleHttpClient($code, $this->getHeaderList($limit, $remaining), 'stats.json');

        /** @var ManagerInterface $manager */
        $manager = $this->container->get('neo_ws_manager_statistics_manager');
        $request = new StatisticsRequest();

        $response = $manager->find($request);
        $this->assertEquals($code, $response->getCode());
        $this->assertEquals($limit, $response->getRateLimit()->getLimit());
        $this->assertEquals($remaining, $response->getRateLimit()->getRemaining());

        /** @var  \Picamator\NeoWsClient\Model\Api\Data\StatisticsInterface $data */
        $data = $response->getData();
        $schema = [
            'neoCount',
            'closeApproachCount',
            'lastUpdated',
            'source',
            'nasaJplUrl',
        ];
        $schema = $this->getMethodList($schema);
        foreach ($schema as $item) {
            $this->assertNotEmpty($data->$item(), sprintf('Method "%s" returns empty data', $item));
        }
    }
}
