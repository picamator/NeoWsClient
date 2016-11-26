<?php
namespace Picamator\NeoWsClient\Example;

/**
 * Resource: GET /rest/v1/stats
 */

require_once 'app.php';

use \Picamator\NeoWsClient\Http\Data\Config;
use \Picamator\NeoWsClient\Request\Data\StatisticsRequest;

// make configuration with wrong api token
$config = new Config([
    'endPoint' => 'https://api.nasa.gov/neo/rest/v1/',
    'apiKey' => 'WRONG_DEMO_KEY',
    'proxy' => $container->get('neo_ws_http_config')->getProxy(),
    'optionList' => [
        'verify' => false
    ]
]);
$container->set('neo_ws_http_config', $config);

/** @var  \Picamator\NeoWsClient\Manager\Manager $manager */
$manager = $container->get('neo_ws_manager_statistics_manager');

// get response
$request = new StatisticsRequest();
$response = $manager->find($request);

/** @var  \stdClass $data */
$data = $response->getData();

echo <<<EOT
=================================
        NEO Wrong Api Key
=================================

HTTP Code                       | {$response->getCode()}
Api key limit                   | {$response->getRateLimit()->getLimit()}
Api key remaining               | {$response->getRateLimit()->getRemaining()}

Error message
-------------

{$response->getData()->scalar}


EOT;
