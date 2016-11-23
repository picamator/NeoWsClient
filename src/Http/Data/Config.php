<?php
namespace Picamator\NeoWsClient\Http\Data;

use Picamator\NeoWsClient\Http\Api\Data\ConfigInterface;
use Picamator\NeoWsClient\Model\Data\PropertySettingTrait;

/**
 * Config value object
 *
 * @codeCoverageIgnore
 */
class Config implements ConfigInterface
{
    use PropertySettingTrait;

    /**
     * @var string
     */
    private $endPoint;

    /**
     * @var string
     */
    private $proxy;

    /**
     * @var string
     */
    private $token;

    /**
     * @var array
     */
    private $optionList;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setPropertySimple('endPoint', $data, 'string');
        $this->setPropertySimpleDefault('proxy', $data, 'string', null);
        $this->setPropertySimple('token', $data, 'string');
        $this->setPropertySimpleDefault('optionList', $data, 'array', []);
    }

    /**
     * @inheritDoc
     */
    public function getEndPoint()
    {
        return $this->endPoint;
    }

    /**
     * @inheritDoc
     */
    public function getProxy()
    {
        return $this->proxy;
    }

    /**
     * @inheritDoc
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @inheritDoc
     */
    public function getOptionList()
    {
        return $this->optionList;
    }
}
