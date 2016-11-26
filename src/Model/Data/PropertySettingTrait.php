<?php
namespace Picamator\NeoWsClient\Model\Data;

use Picamator\NeoWsClient\Exception\InvalidArgumentException;

/**
 * Set value object properties
 */
trait PropertySettingTrait
{
    /**
     * @var array
     */
    private static $dataType = [
        'string' => 'is_string',
        'int' => 'is_int',
        'float' => 'is_float',
        'array' => 'is_array',
        'bool' => 'is_bool',
        'object' => 'is_object',
        'numeric' => 'is_numeric',
    ];

    /**
     * @var string
     */
    private static $collectionType ='Picamator\NeoWsClient\Model\Api\Data\Component\CollectionInterface';

    /**
     * Set simple property: string, int, float, bool, array
     *
     * @param string $property
     * @param array $data
     * @param string $type
     *
     * @throws InvalidArgumentException
     */
    private function setPropertySimple($property, array $data, $type)
    {
        $this->validatePropertyExist($property, $data);

        // simple type
        $propertyValue = $data[$property];
        if (array_key_exists($type, self::$dataType) && !call_user_func(self::$dataType[$type], $propertyValue)) {
            throw new InvalidArgumentException(
                sprintf('Can not set property "%s". Property accepts "%s" but got "%s".', $property, $type, $this->getType($propertyValue))
            );
        }

        $this->$property = $propertyValue;
    }

    /**
     * Set simple property default: string, int, float, bool, array, object, numeric
     *
     * @param string $property
     * @param array $data
     * @param string $type
     * @param mixed $default
     *
     * @throws InvalidArgumentException
     */
    private function setPropertySimpleDefault($property, array $data, $type, $default)
    {
        if(!array_key_exists($property, $data)) {
            $this->$property = $default;
            return;
        }

        // simple type
        $this->setPropertySimple($property, $data, $type);
    }

    /**
     * Set complex property
     *
     * @param string $property
     * @param array $data
     * @param string $type
     *
     * @throws InvalidArgumentException
     */
    private function setPropertyComplex($property, array $data, $type)
    {
        $this->validatePropertyExist($property, $data);

        // complex type
        $propertyValue = $data[$property];
        if (!is_a($propertyValue, $type)) {
            throw new InvalidArgumentException(
                sprintf('Can not set property "%s". Property accepts "%s" but got "%s".', $property, $type, $this->getType($propertyValue))
            );
        }

        $this->$property = $propertyValue;
    }

    /**
     * Set complex property default
     *
     * @param string $property
     * @param array $data
     * @param string $type
     * @param mixed $default
     *
     * @throws InvalidArgumentException
     */
    private function setPropertyComplexDefault($property, array $data, $type, $default)
    {
        if(!array_key_exists($property, $data)) {
            $this->$property = $default;
            return;
        }

        $this->setPropertyComplex($property, $data, $type);
    }

    /**
     * Set collection property
     *
     * @param string $property
     * @param array $data
     * @param string $type
     *
     * @throws InvalidArgumentException
     */
    private function setPropertyCollection($property, array $data, $type)
    {
        $this->validatePropertyExist($property, $data);

        /** @var \Picamator\NeoWsClient\Model\Api\Data\Component\CollectionInterface $propertyValue */
        $propertyValue = $data[$property];
        if (!is_a($propertyValue, self::$collectionType)) {
            throw new InvalidArgumentException(
                sprintf('Can not set property "%s". Property accepts "%s" but got "%s".', $property, $type, $this->getType($propertyValue))
            );
        }

        if ($propertyValue->getType() !== $type) {
            throw new InvalidArgumentException(
                sprintf('Can not set property "%s". Property accepts collection of "%s" objects but got collection of "%s".', $property, $type, $propertyValue->getType())
            );
        }

        $this->$property = $propertyValue;
    }

    /**
     * Set collection property default
     *
     * @param string $property
     * @param array $data
     * @param string $type
     *
     * @throws InvalidArgumentException
     */
    private function setPropertyCollectionDefault($property, array $data, $type, $default)
    {
        if(!array_key_exists($property, $data)) {
            $this->$property = $default;
            return;
        }

        $this->setPropertyCollection($property, $data,  $type);
    }

    /**
     * Validate property exist
     *
     * @param string $property
     * @param array $data
     */
    private function validatePropertyExist($property, array $data)
    {
        if(!array_key_exists($property, $data)) {
            throw new InvalidArgumentException(
                sprintf('Can not set property "%s". Property does present in data set.', $property)
            );
        }
    }

    /**
     * Get type
     *
     * @param mixed $value
     *
     * @return string
     */
    private function getType($value)
    {
        return is_object($value) ? get_class($value) : gettype($value);
    }
}
