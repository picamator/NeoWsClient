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
     * @var string
     */
    private $astronomical;

    /**
     * @var string
     */
    private $lunar;

    /**
     * @var string
     */
    private $kilometers;

    /**
     * @var string
     */
    private $miles;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setPropertySimple('astronomical', $data, 'string');
        $this->setPropertySimple('lunar', $data, 'string');
        $this->setPropertySimple('kilometers', $data, 'string');
        $this->setPropertySimple('miles', $data, 'string');
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
