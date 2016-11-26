<?php
namespace Picamator\NeoWsClient\Tests\Integration\Example;

use Picamator\NeoWsClient\Tests\Integration\BaseTest;

class StatisticsTest extends BaseTest
{
    public function testStatistics()
    {
        $code = 200;
        $limit = 40;
        $remaining = 30;

        // mock http client
        $this->setGuzzleHttpClient($code, $this->getHeaderList($limit, $remaining), 'stats.json');

        ob_start();

        $container = $this->container;
        include_once __DIR__ . '/../../../../../doc/example/statistics.php';
        $content = ob_get_contents();

        ob_end_clean();

        $this->assertTrue(strpos($content, 'NEO Statistics') !== false);
    }
}
