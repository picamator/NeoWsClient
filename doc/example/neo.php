<?php
namespace Picamator\NeoWsClient\Example;

/**
 * Resource: GET /rest/v1/neo/{asteroid_id}
 */

require_once 'app.php';
require_once __DIR__ . '/template/neo.php';

use \Picamator\NeoWsClient\Request\Data\NeoRequest;

/** @var  \Picamator\NeoWsClient\Manager\Manager $manager */
$manager = $container->get('neo_ws_manager_neo_manager');

// get response
$request = new NeoRequest(['asteroidId' => '3729835']);
$response = $manager->find($request);

/** @var  \Picamator\NeoWsClient\Model\Api\Data\NeoInterface $data */
$data = $response->getData();

echo <<<EOT
=================================
         NEO Asteroid
=================================

HTTP Code                       | {$response->getCode()}
Api key limit                   | {$response->getRateLimit()->getLimit()}
Api key remaining               | {$response->getRateLimit()->getRemaining()}


EOT;

showNeoDetailed($data);
