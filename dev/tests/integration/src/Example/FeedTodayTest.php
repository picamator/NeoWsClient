<?php
namespace Picamator\NeoWsClient\Tests\Integration\Example;

use Picamator\NeoWsClient\Tests\Integration\BaseTest;

class FeedTodayTest extends BaseTest
{
    public function testFeedToday()
    {
        $code = 200;
        $limit = 40;
        $remaining = 30;

        // mock http client
        $this->setGuzzleHttpClient($code, $this->getHeaderList($limit, $remaining), 'feed.today.json');

        ob_start();

        $container = $this->container;
        include_once __DIR__ . '/../../../../../doc/example/feed.today.php';
        $content = ob_get_contents();

        ob_end_clean();

        $this->assertTrue(strpos($content, 'NEO Feed Today') !== false);
        $this->assertTrue(strpos($content, 'Links') !== false);
        $this->assertTrue(strpos($content, 'Element count') !== false);
        $this->assertTrue(strpos($content, 'Estimated diameter') !== false);
        $this->assertTrue(strpos($content, 'Close approach data') !== false);
        $this->assertTrue(strpos($content, 'Relative velocity') !== false);
        $this->assertTrue(strpos($content, 'Miss distance') !== false);

        // not present orbital data
        $this->assertFalse(strpos($content, 'Orbital data') !== false);
    }

    public function testFeedTodayDetailed()
    {
        $code = 200;
        $limit = 40;
        $remaining = 30;

        // mock http client
        $this->setGuzzleHttpClient($code, $this->getHeaderList($limit, $remaining), 'feed.today.detailed.json');

        ob_start();

        $container = $this->container;
        include_once __DIR__ . '/../../../../../doc/example/feed.today.detailed.php';
        $content = ob_get_contents();

        ob_end_clean();

        $this->assertTrue(strpos($content, 'NEO Feed Today') !== false);
        $this->assertTrue(strpos($content, 'Links') !== false);
        $this->assertTrue(strpos($content, 'Element count') !== false);
        $this->assertTrue(strpos($content, 'Estimated diameter') !== false);
        $this->assertTrue(strpos($content, 'Close approach data') !== false);
        $this->assertTrue(strpos($content, 'Relative velocity') !== false);
        $this->assertTrue(strpos($content, 'Miss distance') !== false);

        // present orbital data
        $this->assertTrue(strpos($content, 'Orbital data') !== false);
    }
}
