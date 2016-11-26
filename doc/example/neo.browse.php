<?php
/**
 * Resource: GET /rest/v1/neo/browse
 */

require_once 'app.php';
require_once __DIR__ . '/template/neo.php';

use \Picamator\NeoWsClient\Request\Data\NeoBrowseRequest;

/** @var  \Picamator\NeoWsClient\Manager\Manager $manager */
$manager = $container->get('neo_ws_manager_neo_browse_manager');

// get response
$request = new NeoBrowseRequest(['page' => 1, 'size' => 5]);
$response = $manager->find($request);

/** @var  \Picamator\NeoWsClient\Model\Api\Data\Component\NeoBrowseInterface $data */
$data = $response->getData();

echo <<<EOT
=================================
          NEO Browse
=================================

HTTP Code                       | {$response->getCode()}
Api key limit                   | {$response->getRateLimit()->getLimit()}
Api key remaining               | {$response->getRateLimit()->getRemaining()}


Page
----

Size                           | {$data->getPage()->getSize()}
Total elements                 | {$data->getPage()->getTotalElements()}
Total pages                    | {$data->getPage()->getTotalPages()}
Number                         | {$data->getPage()->getNumber()}


Links
-----
Prev                           | {$data->getLink()->getPrev()}
Self                           | {$data->getLink()->getSelf()}
Next                           | {$data->getLink()->getNext()}


EOT;

/** @var \Picamator\NeoWsClient\Model\Api\Data\Component\NeoInterface  $item */
foreach($data->getNeoList() as $item) {
    showNeoDetailed($item);
}
