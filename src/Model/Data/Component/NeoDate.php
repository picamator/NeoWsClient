<?php
namespace Picamator\NeoWsClient\Model\Data\Component;

use Picamator\NeoWsClient\Model\Api\Data\Component\CollectionInterface;
use Picamator\NeoWsClient\Model\Api\Data\Component\NeoDateInterface;
use Picamator\NeoWsClient\Model\Data\PropertySettingTrait;

/**
 * Neo date value object
 *
 * @codeCoverageIgnore
 */
class NeoDate implements NeoDateInterface
{
    use PropertySettingTrait;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var CollectionInterface
     */
    private $neoList;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setPropertyComplex('date', $data, 'DateTime');
        $this->setPropertyCollection('neoList', $data, 'Picamator\NeoWsClient\Model\Api\Data\NeoInterface');
    }

    /**
     * @inheritDoc
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @inheritDoc
     */
    public function getNeoList()
    {
        return $this->neoList;
    }
}
