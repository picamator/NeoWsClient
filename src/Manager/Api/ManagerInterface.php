<?php
namespace Picamator\NeoWsClient\Manager\Api;

use Picamator\NeoWsClient\Exception\HttpClientException;
use Picamator\NeoWsClient\Exception\InvalidArgumentException;
use Picamator\NeoWsClient\Exception\ManagerException;
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
     *
     * @throws ManagerException
     * @throws HttpClientException
     * @throws InvalidArgumentException
     */
    public function find(RequestAwareInterface $request);
}
