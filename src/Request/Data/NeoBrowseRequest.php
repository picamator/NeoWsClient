<?php
namespace Picamator\NeoWsClient\Request\Data;

use Picamator\NeoWsClient\Model\Data\PropertySettingTrait;
use Picamator\NeoWsClient\Request\Api\Data\NeoBrowseRequestInterface;

/**
 * Neo Browse Request
 *
 * @codeCoverageIgnore
 */
class NeoBrowseRequest implements NeoBrowseRequestInterface
{
    use PropertySettingTrait;

    /**
     * @var int
     */
    private $page;

    /**
     * @var int
     */
    private $size;

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
        $this->setPropertySimpleDefault('page', $data, 'int', 0);
        $this->setPropertySimpleDefault('size', $data, 'int', 20);
        $this->setPropertySimpleDefault('resource', $data, 'string', 'neo/browse');

        $this->paramList = [
            'page' => $this->page,
            'size' => $this->size,
        ];
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
    public function getSize()
    {
        return $this->size;
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
