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
        $this->setPropertySimple('astronomical', $data, 'float');
        $this->setPropertySimple('lunar', $data, 'float');
        $this->setPropertySimple('kilometers', $data, 'float');
        $this->setPropertySimple('miles', $data, 'float');
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
        return $this->lunar;
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
