<?php
namespace Picamator\NeoWsClient\Mapper\Data\Component;

use Picamator\NeoWsClient\Mapper\Api\Data\Component\SchemaInterface;
use Picamator\NeoWsClient\Mapper\Api\FilterInterface;
use Picamator\NeoWsClient\Model\Data\PropertySettingTrait;

/**
 * Schema value object
 *
 * @codeCoverageIgnore
 */
class Schema implements SchemaInterface
{
    use PropertySettingTrait;

    /**
     * @var string
     */
    private $source;

    /**
     * @var string
     */
    private $destination;

    /**
     * @var string
     */
    private $destinationContainer;

    /**
     * @var FilterInterface
     */
    private $filter;

    /**
     * @var SchemaInterface
     */
    private $schema;

    /**
     * @param array $data
     * @param SchemaInterface | null $schema
     */
    public function __construct(array $data, FilterInterface $filter = null, SchemaInterface $schema = null)
    {
        $this->setPropertySimple('source', $data, 'string');
        $this->setPropertySimple('destination', $data, 'string');
        $this->setPropertySimple('destinationContainer', $data, 'string');

        $this->schema = $schema;
        $this->filter = $filter;
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
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * @inheritDoc
     */
    public function getDestinationContainer()
    {
        return $this->destinationContainer;
    }

    /**
     * @inheritDoc
     */
    public function getFilter()
    {
        return $this->fitler;
    }

    /**
     * @inheritDoc
     */
    public function getSchema()
    {
       return $this->schema;
    }
}
