<?php
namespace Picamator\NeoWsClient\Model\Data;

use Picamator\NeoWsClient\Model\Api\Data\StatisticsInterface;

/**
 * Statistics value object
 *
 * @codeCoverageIgnore
 */
class Statistics implements StatisticsInterface
{
    use PropertySettingTrait;

    /**
     * @var int
     */
    private $neoCount;

    /**
     * @var int
     */
    private $closeApproachCount;

    /**
     * @var \DateTime
     */
    private $lastUpdated;

    /**
     * @var string
     */
    private $source;

    /**
     * @var string
     */
    private $nasaJplUrl;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setPropertySimple('neoCount', $data, 'int');
        $this->setPropertySimple('closeApproachCount', $data, 'int');
        $this->setPropertyComplex('lastUpdated', $data, 'DateTime');
        $this->setPropertySimple('source', $data, 'string');
        $this->setPropertySimple('nasaJplUrl', $data, 'string');
    }

    /**
     * @inheritDoc
     */
    public function getNeoCount()
    {
        return $this->neoCount;
    }

    /**
     * @inheritDoc
     */
    public function getCloseApproachCount()
    {
        return $this->closeApproachCount;
    }

    /**
     * @inheritDoc
     */
    public function getLastUpdated()
    {
        return $this->lastUpdated;
    }

    /**
     * @inheritDoc
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @inheritDoc
     */
    public function getNasaJplUrl()
    {
        return $this->nasaJplUrl;
    }
}
