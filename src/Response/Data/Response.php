<?php
namespace Picamator\NeoWsClient\Response\Data;

use Picamator\NeoWsClient\Model\Data\PropertySettingTrait;
use Picamator\NeoWsClient\Model\Api\Data\Primitive\RateLimitInterface;
use Picamator\NeoWsClient\Response\Api\Data\ResponseInterface;

/**
 * Response value object
 *
 * @codeCoverageIgnore
 */
class Response  implements ResponseInterface
{
    use PropertySettingTrait;

    /**
     * @var RateLimitInterface
     */
    private $rateLimit;

    /**
     * @var int
     */
    private $code;

    /**
     * @var mixed
     */
    private $data;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setPropertyComplex('rateLimit', $data, 'Picamator\NeoWsClient\Model\Api\Data\Primitive\RateLimitInterface');
        $this->setPropertySimple('code', $data, 'int');
        $this->setPropertySimple('data', $data, 'object');
    }

    /**
     * @inheritDoc
     */
    public function getRateLimit()
    {
        return $this->rateLimit;
    }

    /**
     * @inheritDoc
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @inheritDoc
     */
    public function getData()
    {
        return $this->data;
    }
}
