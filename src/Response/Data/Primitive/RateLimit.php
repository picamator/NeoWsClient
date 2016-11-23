<?php
namespace Picamator\NeoWsClient\Response\Data\Primitive;

use Picamator\NeoWsClient\Model\Data\PropertySettingTrait;
use Picamator\NeoWsClient\Response\Api\Data\Primitive\RateLimitInterface;

/**
 * Rate limit value object
 *
 * @codeCoverageIgnore
 */
class RateLimit implements RateLimitInterface
{
    use PropertySettingTrait;

    /**
     * @var int
     */
    private $limit;

    /**
     * @var int
     */
    private $remaining;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setPropertySimple('limit', $data, 'int');
        $this->setPropertySimple('remaining', $data, 'int');
    }

    /**
     * @inheritDoc
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @inheritDoc
     */
    public function getRemaining()
    {
        return $this->remaining;
    }
}
