<?php
namespace Picamator\NeoWsClient\Manager;

use Picamator\NeoWsClient\Exception\ManagerException;
use Picamator\NeoWsClient\Http\Api\ClientInterface;
use Picamator\NeoWsClient\Manager\Api\Builder\RateLimitFactoryInterface;
use Picamator\NeoWsClient\Manager\Api\ManagerInterface;
use Picamator\NeoWsClient\Mapper\Api\MapperInterface;
use Picamator\NeoWsClient\Mapper\Api\RepositoryInterface;
use Picamator\NeoWsClient\Request\Api\Data\RequestAwareInterface;
use Picamator\NeoWsClient\Response\Api\Builder\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Manager, it's deliberately mark final to encourage composition
 */
final class Manager implements ManagerInterface
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var RateLimitFactoryInterface
     */
    private $rateLimitFactory;

    /**
     * @var ResponseFactoryInterface
     */
    private $responseFactory;

    /**
     * @var RepositoryInterface
     */
    private $repository;

    /**
     * @var MapperInterface
     */
    private $mapper;

    /**
     * @param ClientInterface $client
     * @param RateLimitFactoryInterface $rateLimitFactory
     * @param ResponseFactoryInterface $responseFactory
     * @param MapperInterface $mapper
     * @param RepositoryInterface $repository
     */
    public function __construct(
        ClientInterface $client,
        RateLimitFactoryInterface $rateLimitFactory,
        ResponseFactoryInterface $responseFactory,
        MapperInterface $mapper,
        RepositoryInterface $repository
    ) {
        $this->client = $client;
        $this->rateLimitFactory = $rateLimitFactory;
        $this->responseFactory = $responseFactory;
        $this->mapper = $mapper;
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function find(RequestAwareInterface $request)
    {
        $responseMsg = $this->client->request($request->getResource(), $request->getParamList());

        $code = $responseMsg->getStatusCode();
        $rateLimit = $this->rateLimitFactory->create($responseMsg);
        if($code !== 200) {
            return $this->responseFactory->create($rateLimit, $code, (object) $responseMsg->getBody()->getContents());
        }

        $body = $this->getResponseBody($responseMsg);
        $data = $this->getResponseData($body);

        return $this->responseFactory->create($rateLimit, $code, $data);
    }

    /**
     * Get response body
     *
     * @param ResponseInterface $responseMsg
     *
     * @return array
     *
     * @throws ManagerException
     */
    private function getResponseBody(ResponseInterface $responseMsg)
    {
        $data = json_decode($responseMsg->getBody(), true);
        if (is_null($data)) {
            throw new ManagerException(sprintf('Can not convert to json body string: "%s"', $responseMsg->getBody()));
        }

        return $data;
    }

    /**
     * Get response data
     *
     * @param array $data
     *
     * @return mixed
     */
    private function getResponseData(array $data)
    {
        $schema = $this->repository->findSchema();
        $responseData = $this->mapper->map($schema, $data);

        return $responseData;
    }
}
