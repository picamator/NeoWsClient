<?php
namespace Picamator\NeoWsClient\Mapper\Filter;

use Picamator\NeoWsClient\Mapper\Api\FilterInterface;

/**
 * Filter, convert data to \DateTime object
 *
 * @codeCoverageIgnore
 */
class DateTimeFilter implements FilterInterface
{
    /**
     * Filter
     *
     * @param string $data
     *
     * @return float
     */
    public function filter($data)
    {
        try {
            return new \DateTime($data);
        } catch (\Exception $e) {
            return $data;
        }
    }
}