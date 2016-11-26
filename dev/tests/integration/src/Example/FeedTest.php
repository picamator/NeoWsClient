<?php
namespace Picamator\NeoWsClient\Tests\Integration\Example;

use Picamator\NeoWsClient\Tests\Integration\BaseTest;

class FeedTest extends BaseTest
{
    public function testStatistics()
    {
        $code = 200;
        $limit = 40;
        $remaining = 30;

        // mock http client
        $this->setGuzzleHttpClient($code, $this->getHeaderList($limit, $remaining), 'feed.detailed.json');

        ob_start();

        $container = $this->container;
        include_once __DIR__ . '/../../../../../doc/example/feed.php';
        $content = ob_get_contents();

        ob_end_clean();

        $this->assertTrue(strpos($content, 'NEO Feed 2016-11-24 - 2016-11-25') !== false);
        $this->assertTrue(strpos($content, 'Links') !== false);
        $this->assertTrue(strpos($content, 'Element count') !== false);
        $this->assertTrue(strpos($content, 'Estimated diameter') !== false);
        $this->assertTrue(strpos($content, 'Orbital data') !== false);
        $this->assertTrue(strpos($content, 'Close approach data') !== false);
        $this->assertTrue(strpos($content, 'Relative velocity') !== false);
        $this->assertTrue(strpos($content, 'Miss distance') !== false);
    }
}
