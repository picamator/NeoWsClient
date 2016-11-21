<?php
namespace Picamator\NeoWsClient\Tests\Unit\Model;

use Picamator\NeoWsClient\Model\ObjectManager;
use Picamator\NeoWsClient\Tests\Unit\BaseTest;

class ObjectManagerTest extends BaseTest
{
    /**
     * @var ObjectManager
     */
    private $objectManager;

    protected function setUp()
    {
        parent::setUp();

        $this->objectManager = new ObjectManager();
    }

    /**
     * @dataProvider providerCreate
     *
     * @param array $arguments
     */
    public function testCreate(array $arguments)
    {
        $className = '\DateTime';

        $actual = $this->objectManager->create($className, $arguments);
        $this->assertInstanceOf($className, $actual);
    }

    /**
     * @expectedException \Picamator\NeoWsClient\Exception\RuntimeException
     */
    public function testFailCreate()
    {
        $this->objectManager->create('Picamator\NeoWsClient\Model\ObjectManager', [1, 2]);
    }

    public function providerCreate()
    {
        return [
            [['now']],
            [[]]
        ];
    }
}
