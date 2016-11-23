<?php
namespace Picamator\NeoWsClient\Request\Builder;

use Picamator\NeoWsClient\Exception\InvalidArgumentException;
use Picamator\NeoWsClient\Model\Api\ObjectManagerInterface;
use Picamator\NeoWsClient\Request\Api\Builder\FeedRequestFactoryInterface;

/**
 * Create Feed Request
 */
class FeedRequestFactory implements FeedRequestFactoryInterface
{
    /**
     * @var int
     */
    private static $maxDayLimit = 7;

    /**
     * @var string
     */
    private static $dateFormat = 'Y-m-d';

    /**
     * @var ObjectManagerInterface
     */
    private $objectManager;

    /**
     * @var string
     */
    private $className;

    /**
     * @param ObjectManagerInterface $objectManager
     * @param string $className
     */
    public function __construct(
        ObjectManagerInterface $objectManager,
        $className = 'Picamator\NeoWsClient\Request\Data\FeedRequest'
    ) {
        $this->objectManager = $objectManager;
        $this->className = $className;
    }

    /**
     * @inheritDoc
     */
    public function create($startDate, $endDate)
    {
        $startDateTime = $this->getDateTime($startDate);
        $endDateTime = $this->getDateTime($endDate);

        if ($startDate > $endDate) {
            throw new InvalidArgumentException('Invalid data range. StartDate is greater then EndDate.');
        }

        $range = $startDateTime->diff($endDateTime)->format('%a');
        if ($range > self::$maxDayLimit) {
            throw new InvalidArgumentException(
                sprintf('Data range "%s" days is over limit. Please set data range with max "%s" days.', $range, self::$maxDayLimit)
            );
        }

        $data = [
            'startDate' => $startDate,
            'endDate' => $endDate
        ];

        return $this->objectManager->create($this->className, [$data]);
    }

    /**
     * Get date
     *
     * @param string $date
     *
     * @return \DateTime
     *
     * @throws InvalidArgumentException
     */
    private function getDateTime($date)
    {

        $dateTime = \DateTime::createFromFormat(self::$dateFormat, $date);
        $errorList = \DateTime::getLastErrors();
        if ($dateTime === false || array_sum($errorList)) {
            throw new InvalidArgumentException(
                sprintf('Invalid date "%s". DateTime failed to parse string.', $date)
            );
        }

        return $dateTime;
    }
}
