<?php
namespace Picamator\NeoWsClient\Tests\Integration\Example;

use Picamator\NeoWsClient\Tests\Integration\BaseTest;

class NeoBrowseTest extends BaseTest
{
    public function testNeoBrowse()
    {
        $code = 200;
        $limit = 40;
        $remaining = 30;

        // mock http client
        $this->setGuzzleHttpClient($code, $this->getHeaderList($limit, $remaining), 'neo.browse.json');

        ob_start();

        $container = $this->container;
        include_once __DIR__ . '/../../../../../doc/example/neo.browse.php';
        $content = ob_get_contents();

        ob_end_clean();

        $this->assertTrue(strpos($content, 'NEO Browse') !== false);
        $this->assertTrue(strpos($content, 'Page') !== false);
        $this->assertTrue(strpos($content, 'Links') !== false);
        $this->assertTrue(strpos($content, 'Estimated diameter') !== false);
        $this->assertTrue(strpos($content, 'Orbital data') !== false);
        $this->assertTrue(strpos($content, 'Close approach data') !== false);
        $this->assertTrue(strpos($content, 'Relative velocity') !== false);
        $this->assertTrue(strpos($content, 'Miss distance') !== false);
    }
}
