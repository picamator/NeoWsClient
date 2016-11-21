<?php
namespace Picamator\NeoWsClient\Model\Api\Data;

/**
 * Statistics value object
 */
interface StatisticsInterface
{
    /**
     * Get Neo count
     *
     * @return int
     */
    public function getNeoCount();

    /**
     * Get close approach count
     *
     * @return int
     */
    public function getCloseApproachCount();

    /**
     * Get last updated
     *
     * @return \DateTime
     */
    public function getLastUpdated();

    /**
     * Get source
     *
     * @return string
     */
    public function getSource();

    /**
     * Get NASA jpl url
     *
     * @return string
     */
    public function getNasaJplUrl();
}
