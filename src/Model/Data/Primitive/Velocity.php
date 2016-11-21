<?php
namespace Picamator\NeoWsClient\Model\Data\Primitive;

use Picamator\NeoWsClient\Model\Api\Data\Primitive\VelocityInterface;
use Picamator\NeoWsClient\Model\Data\PropertySettingTrait;

/**
 * Velocity value object
 *
 * @codeCoverageIgnore
 */
class Velocity implements VelocityInterface
{
    use PropertySettingTrait;

    /**
     * @var float
     */
    private $kilometersPerSecond;

    /**
     * @var float
     */
    private $kilometersPerHour;

    /**
     * @var float
     */
    private $milesPerHour;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setPropertySimple('kilometersPerSecond', $data, 'float');
        $this->setPropertySimple('kilometersPerHour', $data, 'float');
        $this->setPropertySimple('milesPerHour', $data, 'float');
    }

    /**
     * @inheritDoc
     */
    public function getKilometersPerSecond()
    {
        return $this->kilometersPerSecond;
    }

    /**
     * @inheritDoc
     */
    public function getKilometersPerHour()
    {
        return $this->kilometersPerHour;
    }

    /**
     * @inheritDoc
     */
    public function getMilesPerHour()
    {
        return $this->milesPerHour;
    }
}
