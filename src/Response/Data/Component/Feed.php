<?php
namespace Picamator\NeoWsClient\Response\Data\Component;

use Picamator\NeoWsClient\Model\Api\Data\Component\CollectionInterface;
use Picamator\NeoWsClient\Model\Data\PropertySettingTrait;
use Picamator\NeoWsClient\Response\Api\Data\Component\FeedInterface;
use Picamator\NeoWsClient\Response\Api\Data\Primitive\PaginatedLinkInterface;

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
    private $neoList;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setPropertyComplex('link', $data, 'Picamator\NeoWsClient\Response\Api\Data\Primitive\PaginatedLinkInterface');
        $this->setPropertySimple('elementCount', $data, 'int');
        $this->setPropertyCollection('neoList', $data, 'Picamator\NeoWsClient\Model\Api\Data\NeoDateInterface');
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
    public function getNeoList()
    {
        return $this->neoList;
    }
}
