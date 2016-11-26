<?php
namespace Picamator\NeoWsClient\Request\Data;

use Picamator\NeoWsClient\Model\Data\PropertySettingTrait;
use Picamator\NeoWsClient\Request\Api\Data\FeedTodayRequestInterface;

/**
 * Feed Today Request
 *
 * @codeCoverageIgnore
 */
class FeedTodayRequest implements FeedTodayRequestInterface
{
    use PropertySettingTrait;

    /**
     * @var bool
     */
    private $detailed;

    /**
     * @var array
     */
    private $paramList;

    /**
     * @var string
     */
    private $resource;

    /**
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->setPropertySimpleDefault('detailed', $data, 'bool', true);
        $this->setPropertySimpleDefault('resource', $data, 'string', 'feed/today');

        $this->paramList = [
            'detailed' => $this->detailed,
        ];
    }

    /**
     * @inheritDoc
     */
    public function getDetailed()
    {
        return $this->detailed;
    }

    /**
     * @inheritDoc
     */
    public function getParamList()
    {
        return $this->paramList;
    }

    /**
     * @inheritDoc
     */
    public function getResource()
    {
        return $this->resource;
    }
}
