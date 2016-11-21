<?php
namespace Picamator\NeoWsClient\Model\Data\Component;

use Picamator\NeoWsClient\Model\Api\Data\Component\CollectionInterface;
use Picamator\NeoWsClient\Model\Data\PropertySettingTrait;

/**
 * Collection
 *
 * @codeCoverageIgnore
 */
class Collection implements CollectionInterface
{
    use PropertySettingTrait;

    /**
     * @var array
     */
    private $data;

    /**
     * @var string
     */
    private $type;

    /**
     * @var int
     */
    private $count;

    /**
     * @var \ArrayIterator
     */
    private $iterator;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setPropertySimple('type', $data, 'string');
        $this->setPropertySimple('data', $data, 'array');

        $this->iterator = new \ArrayIterator($data);
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        return $this->iterator;
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        if (is_null($this->count)) {
            $this->count = count($this->data);
        }

        return $this->count;
    }
}
