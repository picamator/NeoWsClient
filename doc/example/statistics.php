<?php
/**
 * Resource: GET /rest/v1/stats
 */

require_once 'app.php';

use \Picamator\NeoWsClient\Request\Data\StatisticsRequest;

/** @var  \Picamator\NeoWsClient\Manager\Manager $manager */
$manager = $container->get('neo_ws_manager_statistics_manager');

// get response
$request = new StatisticsRequest();
$response = $manager->find($request);

/** @var  \Picamator\NeoWsClient\Model\Api\Data\StatisticsInterface $data */
$data = $response->getData();

echo <<<EOT
=================================
        NEO Statistics
=================================

HTTP Code               | {$response->getCode()}
Api key limit           | {$response->getRateLimit()->getLimit()}
Api key remaining       | {$response->getRateLimit()->getRemaining()}


Close approach count    | {$data->getCloseApproachCount()}
Last updated            | {$data->getLastUpdated()->format('Y-m-d')}
NEO count               | {$data->getNeoCount()}
Source                  | {$data->getSource()}
NASA JPL url            | {$data->getNasaJplUrl()}

EOT;
