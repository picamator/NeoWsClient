<?php
namespace Picamator\NeoWsClient\Response\Builder;

use Picamator\NeoWsClient\Model\Api\ObjectManagerInterface;
use Picamator\NeoWsClient\Response\Api\Builder\ResponseFactoryInterface;
use Picamator\NeoWsClient\Response\Api\Data\Primitive\RateLimitInterface;

/**
 * Create Response
 *
 * @codeCoverageIgnore
 */
class ResponseFactory implements ResponseFactoryInterface
{
    /**
     * @var ObjectManagerInterface
     */
    private $objectManager;

    /**
     * @var string
     */
    private $className;

    /**
     * @param ObjectManagerInterface $objectManager
     * @param string $className
     */
    public function __construct(
        ObjectManagerInterface $objectManager,
        $className = 'Picamator\NeoWsClient\Response\Data\Response'
    ) {
        $this->objectManager = $objectManager;
        $this->className = $className;
    }


    /**
     * @inheritDoc
     */
    public function create(RateLimitInterface $rateLimit, $code, $data)
    {
        return $this->objectManager->create($this->className, [[
            'rateLimit' => $rateLimit,
            'code' => $code,
            'data' => $data
        ]]);
    }
}
