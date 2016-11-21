<?php
namespace Picamator\NeoWsClient\Model\Data\Component;

use Picamator\NeoWsClient\Model\Api\Data\Component\CloseApproachInterface;
use Picamator\NeoWsClient\Model\Api\Data\Primitive\DistanceInterface;
use Picamator\NeoWsClient\Model\Api\Data\Primitive\VelocityInterface;
use Picamator\NeoWsClient\Model\Data\PropertySettingTrait;

/**
 * Close approach value object
 *
 * @codeCoverageIgnore
 */
class CloseApproach implements CloseApproachInterface
{
    use PropertySettingTrait;

    /**
     * @var \DateTime
     */
    private $closeApproachDate;

    /**
     * @var int
     */
    private $epochDateCloseApproach;

    /**
     * @var VelocityInterface
     */
    private $relativeVelocity;

    /**
     * @var DistanceInterface
     */
    private $missDistance;

    /**
     * @var string
     */
    private $orbitingBody;

    /**
     * @param array $data
     */
    public function __construct(array $data) {
        $this->setPropertyComplex('relativeVelocity', $data, 'Picamator\NeoWsClient\Model\Api\Data\Primitive\VelocityInterface');
        $this->setPropertyComplex('missDistance', $data, 'Picamator\NeoWsClient\Model\Api\Data\Primitive\DistanceInterface');
        $this->setPropertyComplex('closeApproachTime', $data, 'DateTime');
        $this->setPropertySimple('epochDateCloseApproach', $data, 'int');
        $this->setPropertySimple('orbitingBody', $data, 'string');
    }

    /**
     * @inheritDoc
     */
    public function getCloseApproachDate()
    {
        return $this->closeApproachDate;
    }

    /**
     * @inheritDoc
     */
    public function getEpochDateCloseApproach()
    {
        return $this->epochDateCloseApproach;
    }

    /**
     * @inheritDoc
     */
    public function getRelativeVelocity()
    {
        return $this->relativeVelocity;
    }

    /**
     * @inheritDoc
     */
    public function getMissDistance()
    {
        return $this->missDistance;
    }

    /**
     * @inheritDoc
     */
    public function getOrbitingBody()
    {
        return $this->orbitingBody;
    }
}
