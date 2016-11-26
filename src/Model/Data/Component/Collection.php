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
        if (is_null($this->iterator)) {
            $this->iterator = new \ArrayIterator($this->data);
        }

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

    /**
     * @inheritDoc
     */
    public function serialize()
    {
        return serialize([$this->type, $this->data]);
    }

    /**
     * @inheritDoc
     */
    public function unserialize($serialized)
    {
        list($this->type, $this->data) = unserialize($serialized);
    }
}
