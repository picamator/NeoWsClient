<?php
namespace Picamator\NeoWsClient\Mapper\Data;

use Picamator\NeoWsClient\Mapper\Api\Data\SchemaInterface;
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
     */
    public function __construct(array $data)
    {
        $this->setPropertySimple('source', $data, 'string');
        $this->setPropertySimple('destination', $data, 'string');
        $this->setPropertySimple('destinationContainer', $data, 'string');

        $this->setPropertyComplexDefault('filter', $data, 'Picamator\NeoWsClient\Mapper\Api\FilterInterface', null);
        $this->setPropertyComplexDefault('schema', $data, 'Picamator\NeoWsClient\Mapper\Api\Data\SchemaInterface', null);
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
        return $this->filter;
    }

    /**
     * @inheritDoc
     */
    public function getSchema()
    {
       return $this->schema;
    }
}
