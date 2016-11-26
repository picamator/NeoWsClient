<?php
namespace Picamator\NeoWsClient\Request\Data;

use Picamator\NeoWsClient\Model\Data\PropertySettingTrait;
use Picamator\NeoWsClient\Request\Api\Data\FeedRequestInterface;

/**
 * Feed Request
 *
 * @codeCoverageIgnore
 */
class FeedRequest implements FeedRequestInterface
{
    use PropertySettingTrait;

    /**
     * @var string
     */
    private $startDate;

    /**
     * @var string
     */
    private $endDate;

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
    public function __construct(array $data)
    {
        $this->setPropertySimple('startDate', $data, 'string');
        $this->setPropertySimple('endDate', $data, 'string');
        $this->setPropertySimpleDefault('detailed', $data, 'bool', true);
        $this->setPropertySimpleDefault('resource', $data, 'string', 'feed');

        $this->paramList = [
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
            'detailed' => $this->detailed,
        ];
    }

    /**
     * @inheritDoc
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @inheritDoc
     */
    public function getEndDate()
    {
        return $this->endDate;
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
