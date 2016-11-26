<?php
namespace Picamator\NeoWsClient\Example;

/**
 * Resource: GET /rest/v1/feed
 */

require_once 'app.php';
require_once __DIR__ . '/template/neo.php';

/** @var  \Picamator\NeoWsClient\Manager\Manager $manager */
$manager = $container->get('neo_ws_manager_feed_manager');

// get response
$startDate = '2016-11-24';
$endDate = '2016-11-25';

/** @var \Picamator\NeoWsClient\Request\Builder\FeedRequestFactory $requestFactory */
$requestFactory = $container->get('neo_ws_request_builder_feed_request_factory');
$request = $requestFactory->create($startDate, $endDate);

$response = $manager->find($request);

/** @var  \Picamator\NeoWsClient\Model\Api\Data\FeedInterface $data */
$data = $response->getData();

echo <<<EOT
=================================================
        NEO Feed {$startDate} - {$endDate}
=================================================

HTTP Code               | {$response->getCode()}
Api key limit           | {$response->getRateLimit()->getLimit()}
Api key remaining       | {$response->getRateLimit()->getRemaining()}


Links
-----
Prev                    | {$data->getLink()->getPrev()}
Self                    | {$data->getLink()->getSelf()}
Next                    | {$data->getLink()->getNext()}

Element count           | {$data->getElementCount()}


EOT;

/** @var \Picamator\NeoWsClient\Model\Api\Data\Component\NeoDateInterface $item */
foreach($data->getNeoDateList() as $item) {
    echo <<<EOT
--------------------------------
{$item->getDate()->format('Y-m-d')}
================================


EOT;

    /** @var \Picamator\NeoWsClient\Model\Api\Data\NeoInterface $neoItem */
    foreach($item->getNeoList() as $neoItem) {
        showNeoDetailed($neoItem);
    }
}
