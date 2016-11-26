<?php
/**
 * Resource: GET /rest/v1/stats
 */

require_once 'app.php';

use \Picamator\NeoWsClient\Request\Data\StatisticsRequest;

/** @var  \Picamator\NeoWsClient\Manager\Manager $manager */
$manager = $container->get('neo_ws_manager_statistics_manager');

// get response
$request = new StatisticsRequest(['resource' => 'wrong-resource']);
$response = $manager->find($request);

/** @var  \stdClass $data */
$data = $response->getData();

echo <<<EOT
=================================
       NEO Wrong Resource
=================================

HTTP Code                       | {$response->getCode()}
Api key limit                   | {$response->getRateLimit()->getLimit()}
Api key remaining               | {$response->getRateLimit()->getRemaining()}

Error message
-------------

{$response->getData()->scalar}


EOT;
