<?php
namespace Picamator\NeoWsClient\Manager\Api;

use Picamator\NeoWsClient\Exception\HttpClientException;
use Picamator\NeoWsClient\Exception\RuntimeException;
use Picamator\NeoWsClient\Request\Api\Data\RequestAwareInterface;
use Picamator\NeoWsClient\Response\Api\Data\ResponseInterface;

/**
 * Manager
 */
interface ManagerInterface
{
    /**
     * Find
     *
     * @param RequestAwareInterface $request
     *
     * @return ResponseInterface
     *
     * @throws HttpClientException
     * @throws RuntimeException
     */
    public function find(RequestAwareInterface $request);
}
