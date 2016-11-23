<?php
namespace Picamator\NeoWsClient\Request\Data;

use Picamator\NeoWsClient\Model\Data\PropertySettingTrait;
use Picamator\NeoWsClient\Request\Api\Data\NeoRequestInterface;

/**
 * Neo Request
 *
 * @codeCoverageIgnore
 */
class NeoRequest implements NeoRequestInterface
{
    use PropertySettingTrait;

    /**
     * @var string
     */
    private $asteroidId;

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
    public function __construct(array $data)
    {
        $this->setPropertySimple('asteroidId', $data, 'string');
        $this->setPropertySimpleDefault('resource', $data, 'string', 'neo');

        $this->resource = trim('/\\', $this->resource) . '/' . $this->asteroidId;
        $this->paramList = [];
    }

    /**
     * @inheritDoc
     */
    public function getAsteroidId()
    {
        return $this->asteroidId;
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
