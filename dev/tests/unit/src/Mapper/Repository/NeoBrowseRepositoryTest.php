<?php
namespace Picamator\NeoWsClient\Tests\Unit\Mapper\Repository;

use Picamator\NeoWsClient\Mapper\Repository\NeoBrowseRepository;
use Picamator\NeoWsClient\Tests\Unit\BaseTest;

class NeoBrowseRepositoryTest extends BaseTest
{
    /**
     * @var NeoBrowseRepository
     */
    private $repository;

    /**
     * @var \Picamator\NeoWsClient\Mapper\Api\Builder\SchemaCollectionFactoryInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $schemaFactoryMock;

    /**
     * @var \Picamator\NeoWsClient\Mapper\Api\RepositoryInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $repositoryMock;

    protected  function setUp()
    {
        parent::setUp();

        $this->schemaFactoryMock = $this->getMockBuilder('Picamator\NeoWsClient\Mapper\Api\Builder\SchemaCollectionFactoryInterface')
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder('Picamator\NeoWsClient\Mapper\Api\RepositoryInterface')
            ->getMock();

        $this->repository = new NeoBrowseRepository($this->schemaFactoryMock, $this->repositoryMock);
    }

    public function testFindSchema()
    {
        // repository mock
        $this->repositoryMock->expects($this->once())
            ->method('getSchemaConfig');

        // factory mock
        $this->schemaFactoryMock->expects($this->once())
            ->method('create');

        $this->repository->findSchema();
    }

    public function testGetSchemaConfig()
    {
        // repository mock
        $this->repositoryMock->expects($this->once())
            ->method('getSchemaConfig');

        $this->repository->getSchemaConfig();
    }
}
