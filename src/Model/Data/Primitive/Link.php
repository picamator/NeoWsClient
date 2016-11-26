<?php
namespace Picamator\NeoWsClient\Model\Data\Primitive;

use Picamator\NeoWsClient\Model\Api\Data\Primitive\LinkInterface;
use Picamator\NeoWsClient\Model\Data\PropertySettingTrait;

/**
 * Link value object
 *
 * @codeCoverageIgnore
 */
class Link implements LinkInterface
{
    use PropertySettingTrait;

    /**
     * @var string
     */
    private $self;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setPropertySimple('self', $data, 'string');
    }

    /**
     * @inheritDoc
     */
    public function getSelf()
    {
        return $this->self;
    }
}
