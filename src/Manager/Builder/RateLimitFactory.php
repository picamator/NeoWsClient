<?php
namespace Picamator\NeoWsClient\Manager\Builder;

use Picamator\NeoWsClient\Manager\Api\Builder\RateLimitFactoryInterface;
use Picamator\NeoWsClient\Model\Api\ObjectManagerInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Rate limit value object
 */
class RateLimitFactory implements RateLimitFactoryInterface
{
    /**
     * @var string
     */
    private static $rateLimitHeader = 'x-ratelimit-limit';

    /**
     * @var string
     */
    private static $rateRemainingHeader = 'x-ratelimit-remaining';

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
        $className = 'Picamator\NeoWsClient\Response\Data\Primitive\RateLimit'
    ) {
        $this->objectManager = $objectManager;
        $this->className = $className;
    }

    /**
     * @inheritDoc
     */
    public function create(ResponseInterface $response)
    {
        $data = [
            'limit' => $response->getHeader(self::$rateLimitHeader),
            'remaining' => $response->getHeader(self::$rateRemainingHeader),
        ];

        $data = array_map(function($item) {
            return intval(current($item));
        }, $data);

        return $this->objectManager->create($this->className, [$data]);
    }
}
