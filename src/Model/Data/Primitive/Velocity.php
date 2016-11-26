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
     * @var string
     */
    private $kilometersPerSecond;

    /**
     * @var string
     */
    private $kilometersPerHour;

    /**
     * @var string
     */
    private $milesPerHour;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setPropertySimple('kilometersPerSecond', $data, 'string');
        $this->setPropertySimple('kilometersPerHour', $data, 'string');
        $this->setPropertySimple('milesPerHour', $data, 'string');
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
