<?php
namespace Picamator\NeoWsClient\Tests\Integration\Example;

use Picamator\NeoWsClient\Tests\Integration\BaseTest;

class WrongResourceTest extends BaseTest
{
    public function testStatistics()
    {
        $code = 404;
        $limit = 40;
        $remaining = 30;

        // mock http client
        $this->setGuzzleHttpClient($code, $this->getHeaderList($limit, $remaining), 'wrong.resource.json');

        ob_start();

        $container = $this->container;
        include_once __DIR__ . '/../../../../../doc/example/wrong.resource.php';
        $content = ob_get_contents();

        ob_end_clean();

        $this->assertTrue(strpos($content, 'NEO Wrong Resource') !== false);
        $this->assertTrue(strpos($content, 'Error message') !== false);
        $this->assertTrue(strpos($content, 'NOT_FOUND') !== false);
    }
}
