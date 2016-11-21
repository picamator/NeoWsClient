<?php
namespace Picamator\NeoWsClient\Model\Data;

use Picamator\NeoWsClient\Model\Api\Data\Component\CollectionInterface;
use Picamator\NeoWsClient\Model\Api\Data\NeoDateInterface;

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
