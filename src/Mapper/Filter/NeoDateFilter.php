<?php
namespace Picamator\NeoWsClient\Mapper\Filter;

use Picamator\NeoWsClient\Exception\InvalidArgumentException;
use Picamator\NeoWsClient\Mapper\Api\FilterInterface;

/**
 * Neo date filter, regroup data to ['date' => ..., 'neo' => [[...]]]
 */
class NeoDateFilter implements FilterInterface
{
    /**
     * Filter
     *
     * @param string $data
     *
     * @return array
     */
    public function filter($data)
    {
        if (!is_array($data)) {
            throw new InvalidArgumentException('Can not filter data. Data is not array.');
        }

        $neoDate = [];
        foreach($data as $key => $value) {
            $neoDate[] = [
                'date' => $key,
                'neo' => $value
            ];
        }

        return $neoDate;
    }
}
