<?php
namespace Picamator\NeoWsClient\Model\Data\Primitive;

use Picamator\NeoWsClient\Model\Data\PropertySettingTrait;
use Picamator\NeoWsClient\Model\Api\Data\Primitive\PaginatedLinkInterface;

/**
 * Paginated link value object
 *
 * @codeCoverageIgnore
 */
class PaginatedLink implements PaginatedLinkInterface
{
    use PropertySettingTrait;

    /**
     * @var string | null
     */
    private $next;

    /**
     * @var string | null
     */
    private $prev;

    /**
     * @var string
     */
    private $self;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setPropertySimpleDefault('next', $data, 'string', null);
        $this->setPropertySimpleDefault('prev', $data, 'string', null);
        $this->setPropertySimple('self', $data, 'string');
    }

    /**
     * @inheritDoc
     */
    public function getNext()
    {
        return $this->next;
    }

    /**
     * @inheritDoc
     */
    public function getPrev()
    {
        return $this->prev;
    }

    /**
     * @inheritDoc
     */
    public function getSelf()
    {
        return $this->self;
    }
}
