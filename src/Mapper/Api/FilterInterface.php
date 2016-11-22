<?php
namespace Picamator\NeoWsClient\Mapper\Api;

/**
 * Filter
 */
interface FilterInterface
{
    /**
     * Filter
     *
     * @param mixed $data
     *
     * @return mixed
     */
    public function filter($data);
}
