<?php
namespace Picamator\NeoWsClient\Manager;

use Picamator\NeoWsClient\Exception\RuntimeException;
use Picamator\NeoWsClient\Http\Api\ClientInterface;
use Picamator\NeoWsClient\Manager\Api\Builder\RateLimitFactoryInterface;
use Picamator\NeoWsClient\Manager\Api\ManagerInterface;
use Picamator\NeoWsClient\Request\Api\Data\RequestAwareInterface;
use Picamator\NeoWsClient\Response\Api\Builder\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Abstract manager
 */
abstract class AbstractManager implements ManagerInterface
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
     * @param ClientInterface $client
     * @param RateLimitFactoryInterface $rateLimitFactory
     * @param ResponseFactoryInterface $responseFactory
     */
    public function __construct(
        ClientInterface $client,
        RateLimitFactoryInterface $rateLimitFactory,
        ResponseFactoryInterface $responseFactory
    ) {
        $this->client = $client;
        $this->rateLimitFactory = $rateLimitFactory;
        $this->responseFactory = $responseFactory;
    }

    /**
     * @inheritDoc
     */
    final public function find(RequestAwareInterface $request)
    {
        $responseMsg = $this->client->request($request->getResource(), $request->getParamList());

        $code = $responseMsg->getStatusCode();
        $rateLimit = $this->rateLimitFactory->create($responseMsg);
        if($code !== 200) {
            return $this->responseFactory->create($rateLimit, $code, new \stdClass());
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
     * @throws RuntimeException
     */
    private function getResponseBody(ResponseInterface $responseMsg)
    {
        $data = json_decode($responseMsg->getBody(), true);
        if (is_null($data)) {
            throw new RuntimeException(sprintf('Can not convert to json body string: "%s"', $responseMsg->getBody()));
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
    abstract protected function getResponseData(array $data);
}
