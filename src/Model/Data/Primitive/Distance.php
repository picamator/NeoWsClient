<?php
namespace Picamator\NeoWsClient\Model\Data\Primitive;

use Picamator\NeoWsClient\Model\Api\Data\Primitive\DistanceInterface;
use Picamator\NeoWsClient\Model\Data\PropertySettingTrait;

/**
 * Distance value object
 *
 * @codeCoverageIgnore
 */
class Distance implements DistanceInterface
{
    use PropertySettingTrait;

    /**
     * @var float
     */
    private $astronomical;

    /**
     * @var float
     */
    private $lunar;

    /**
     * @var float
     */
    private $kilometers;

    /**
     * @var float
     */
    private $miles;

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
    public function getAstronomical()
    {
        return $this->astronomical;
    }

    /**
     * @inheritDoc
     */
    public function getLunar()
    {
        return $this->getLunar();
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
    public function getMiles()
    {
        return $this->miles;
    }
}
