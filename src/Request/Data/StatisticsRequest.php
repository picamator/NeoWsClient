<?php
namespace Picamator\NeoWsClient\Request\Data;

use Picamator\NeoWsClient\Model\Data\PropertySettingTrait;
use Picamator\NeoWsClient\Request\Api\Data\StatisticsRequestInterface;

/**
 * Statistics Request
 *
 * @codeCoverageIgnore
 */
class StatisticsRequest implements StatisticsRequestInterface
{
    use PropertySettingTrait;

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
        $this->setPropertySimpleDefault('resource', $data, 'string', 'stats');

        $this->paramList = [];
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
