<?php
namespace Picamator\NeoWsClient\Model\Data;

use Picamator\NeoWsClient\Model\Api\Data\Component\CollectionInterface;
use Picamator\NeoWsClient\Model\Api\Data\FeedInterface;
use Picamator\NeoWsClient\Model\Api\Data\Primitive\PaginatedLinkInterface;

/**
 * Feed value object
 *
 * @codeCoverageIgnore
 */
class Feed implements FeedInterface
{
    use PropertySettingTrait;

    /**
     * @var PaginatedLinkInterface
     */
    private $link;

    /**
     * @var int
     */
    private $elementCount;

    /**
     * @var CollectionInterface
     */
    private $neoDateList;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setPropertyComplex('link', $data, 'Picamator\NeoWsClient\Model\Api\Data\Primitive\PaginatedLinkInterface');
        $this->setPropertySimple('elementCount', $data, 'int');
        $this->setPropertyCollection('neoDateList', $data, 'Picamator\NeoWsClient\Model\Api\Data\Component\NeoDateInterface');
    }

    /**
     * @inheritDoc
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @inheritDoc
     */
    public function getElementCount()
    {
        return $this->elementCount;
    }

    /**
     * @inheritDoc
     */
    public function getNeoDateList()
    {
        return $this->neoDateList;
    }
}
