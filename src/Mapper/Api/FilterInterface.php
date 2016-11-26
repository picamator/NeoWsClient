<?php
namespace Picamator\NeoWsClient\Mapper\Api;

use Picamator\NeoWsClient\Exception\InvalidArgumentException;

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
     *
     * @throws InvalidArgumentException
     */
    public function filter($data);
}
