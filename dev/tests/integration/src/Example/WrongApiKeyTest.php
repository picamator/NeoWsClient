<?php
namespace Picamator\NeoWsClient\Tests\Integration\Example;

use Picamator\NeoWsClient\Tests\Integration\BaseTest;

class WrongApiKeyTest extends BaseTest
{
    public function testStatistics()
    {
        $code = 403;

        // mock http client
        $this->setGuzzleHttpClient($code, [], 'wrong.api.key.json');

        ob_start();

        $container = $this->container;
        include_once __DIR__ . '/../../../../../doc/example/wrong.api.key.php';
        $content = ob_get_contents();

        ob_end_clean();

        $this->assertTrue(strpos($content, 'NEO Wrong Api Key') !== false);
        $this->assertTrue(strpos($content, 'Error message') !== false);
        $this->assertTrue(strpos($content, 'API_KEY_INVALID') !== false);
    }
}
