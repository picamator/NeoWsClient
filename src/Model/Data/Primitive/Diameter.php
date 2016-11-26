<?php
namespace Picamator\NeoWsClient\Model\Data\Primitive;

use Picamator\NeoWsClient\Model\Api\Data\Primitive\DiameterInterface;
use Picamator\NeoWsClient\Model\Data\PropertySettingTrait;

/**
 * Diameter value object
 *
 * @codeCoverageIgnore
 */
class Diameter implements DiameterInterface
{
    use PropertySettingTrait;

    /**
     * @var numeric
     */
    private $estimatedDiameterMin;

    /**
     * @var numeric
     */
    private $estimatedDiameterMax;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setPropertySimple('estimatedDiameterMin', $data, 'numeric');
        $this->setPropertySimple('estimatedDiameterMax', $data, 'numeric');
    }

    /**
     * @inheritDoc
     */
    public function getEstimatedDiameterMin()
    {
        return $this->estimatedDiameterMin;
    }

    /**
     * @inheritDoc
     */
    public function getEstimatedDiameterMax()
    {
        return $this->estimatedDiameterMax;
    }
}
