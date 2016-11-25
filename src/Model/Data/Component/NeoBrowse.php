<?php
namespace Picamator\NeoWsClient\Model\Data\Component;

use Picamator\NeoWsClient\Model\Api\Data\Component\CollectionInterface;
use Picamator\NeoWsClient\Model\Data\PropertySettingTrait;
use Picamator\NeoWsClient\Model\Api\Data\Component\NeoBrowseInterface;
use Picamator\NeoWsClient\Model\Api\Data\Primitive\PageInterface;
use Picamator\NeoWsClient\Model\Api\Data\Primitive\PaginatedLinkInterface;

/**
 * Neo browse value object
 *
 * @codeCoverageIgnore
 */
class NeoBrowse implements NeoBrowseInterface
{
    use PropertySettingTrait;

    /**
     * @var PaginatedLinkInterface
     */
    private $link;

    /**
     * @var PageInterface
     */
    private $page;

    /**
     * @var CollectionInterface
     */
    private $neoList;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setPropertyComplex('link', $data, 'Picamator\NeoWsClient\Model\Api\Data\Primitive\PaginatedLinkInterface');
        $this->setPropertyComplex('page', $data, 'Picamator\NeoWsClient\Model\Api\Data\Primitive\PageInterface');
        $this->setPropertyCollection('neoList', $data, 'Picamator\NeoWsClient\Model\Api\Data\NeoInterface');
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
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @inheritDoc
     */
    public function getNeoList()
    {
        return $this->neoList;
    }
}
