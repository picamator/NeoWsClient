<?php
namespace Picamator\NeoWsClient\Manager;

use Picamator\NeoWsClient\Http\Api\ClientInterface;
use Picamator\NeoWsClient\Manager\Api\Builder\RateLimitFactoryInterface;
use Picamator\NeoWsClient\Manager\Api\StatisticsManagerInterface;
use Picamator\NeoWsClient\Mapper\Api\MapperInterface;
use Picamator\NeoWsClient\Mapper\Api\RepositoryInterface;
use Picamator\NeoWsClient\Response\Api\Builder\ResponseFactoryInterface;

/**
 * Neo manager
 */
class NeoManager extends AbstractManager
{
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
        parent::__construct($client, $rateLimitFactory, $responseFactory);

        $this->mapper = $mapper;
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    final protected function getResponseData(array $data)
    {
        $schema = $this->repository->findSchema();
        $responseData = $this->mapper->map($schema, $data);

        return $responseData;
    }
}
