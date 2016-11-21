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
     * @var float
     */
    private $estimatedDiameterMin;

    /**
     * @var float
     */
    private $estimatedDiameterMax;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setPropertyData($data);
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
