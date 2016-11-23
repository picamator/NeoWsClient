<?php
namespace Picamator\NeoWsClient\Response\Data\Primitive;

use Picamator\NeoWsClient\Model\Data\PropertySettingTrait;
use Picamator\NeoWsClient\Response\Api\Data\Primitive\PageInterface;

/**
 * Page value object
 *
 * @codeCoverageIgnore
 */
class Page implements PageInterface
{
    use PropertySettingTrait;

    /**
     * @var int
     */
    private $size;

    /**
     * @var int
     */
    private $totalElements;

    /**
     * @var int
     */
    private $totalPages;

    /**
     * @var int
     */
    private $number;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setPropertySimple('size', $data, 'int');
        $this->setPropertySimple('totalElements', $data, 'int');
        $this->setPropertySimple('totalPages', $data, 'int');
        $this->setPropertySimple('number', $data, 'int');
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
    public function getTotalElements()
    {
        return $this->totalElements;
    }

    /**
     * @inheritDoc
     */
    public function getTotalPages()
    {
        return $this->totalPages;
    }

    /**
     * @inheritDoc
     */
    public function getNumber()
    {
        return $this->number;
    }
}
