<?php
namespace Picamator\NeoWsClient\Model\Data\Component;

use Picamator\NeoWsClient\Model\Api\Data\Component\EstimatedDiameterInterface;
use Picamator\NeoWsClient\Model\Api\Data\Primitive\DiameterInterface;
use Picamator\NeoWsClient\Model\Data\PropertySettingTrait;

/**
 * Estimated diameter value object
 *
 * @codeCoverageIgnore
 */
class EstimateDiameter implements EstimatedDiameterInterface
{
    use PropertySettingTrait;

    /**
     * @var DiameterInterface
     */
    private $kilometers;

    /**
     * @var DiameterInterface
     */
    private $meters;

    /**
     * @var DiameterInterface
     */
    private $miles;

    /**
     * @var DiameterInterface
     */
    private $feet;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setPropertyComplex('kilometers', $data, 'Picamator\NeoWsClient\Model\Api\Data\Primitive\DiameterInterface');
        $this->setPropertyComplex('meters', $data, 'Picamator\NeoWsClient\Model\Api\Data\Primitive\DiameterInterface');
        $this->setPropertyComplex('miles', $data, 'Picamator\NeoWsClient\Model\Api\Data\Primitive\DiameterInterface');
        $this->setPropertyComplex('feet', $data, 'Picamator\NeoWsClient\Model\Api\Data\Primitive\DiameterInterface');
    }

    /**
     * @inheritDoc
     */
    public function getKilometers()
    {
        return $this->kilometers;
    }

    /**
     * @inheritDoc
     */
    public function getMeters()
    {
        return $this->meters;
    }

    /**
     * @inheritDoc
     */
    public function getMiles()
    {
        return $this->miles;
    }

    /**
     * @inheritDoc
     */
    public function getFeet()
    {
        return $this->feet;
    }
}
