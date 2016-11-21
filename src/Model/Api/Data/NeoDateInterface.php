<?php
namespace Picamator\NeoWsClient\Model\Api\Data;

use Picamator\NeoWsClient\Model\Api\Data\Component\CollectionInterface;

/**
 * Neo date value object
 */
interface NeoDateInterface
{
    /**
     * @return \DateTime
     */
    public function getDate();

    /**
     * Get Neo list
     *
     * @return CollectionInterface
     */
    public function getNeoList();
}
