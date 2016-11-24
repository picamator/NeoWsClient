<?php
namespace Picamator\NeoWsClient\Http\Api;

use Picamator\NeoWsClient\Exception\HttpClientException;
use Psr\Http\Message\ResponseInterface;

/**
 * Client
 */
interface ClientInterface
{
    /**
     * Request
     *
     * @param string $resource
     * @param array $paramList
     *
     * @return ResponseInterface
     *
     * @throws HttpClientException
     */
    public function request($resource, array $paramList = []);
}
