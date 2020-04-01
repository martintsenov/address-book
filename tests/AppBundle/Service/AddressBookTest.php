<?php

namespace Tests\AppBundle\Service;

use AppBundle\Service\AddressBook as AddressBookService;
use AppBundle\Entity\AddressBook as AddressBookEntity;
use PHPUnit\Framework\TestCase;

class AddressBookTest extends TestCase
{
    /** @var \AppBundle\Repository\AddressBookInterface */
    private $repositoryMock;

    protected function setUp()
    {
        $this->repositoryMock = $this->getRepositoryMock();
        parent::setUp();
    }

    /**
     * @covers \AppBundle\Service\AddressBookInterface::getById
     */
    public function testGetById()
    {
        $repositoryMock = $this->repositoryMock;
        $repositoryMock->expects($this->any())
            ->method('findById')
            ->will($this->returnValue($this->getEntityMock()));
        $service = new AddressBookService($repositoryMock);
        $result = $service->getById(1);

        $this->assertInstanceOf('AppBundle\Entity\AddressBook', $result);
        $this->assertEquals('First Name Test', $result->getFirstName());
        $this->assertEquals('Last Name Test', $result->getLastName());
        $this->assertEquals('Augsburg', $result->getCity());
        $this->assertEquals('Germany', $result->getCountry());
        $this->assertEquals('12345', $result->getZipCode());
    }

    /**
     * @covers \AppBundle\Service\AddressBookInterface::delete
     */
    public function testDeleteEntityNotExist()
    {
        $repositoryMock = $this->repositoryMock;
        $repositoryMock->expects($this->any())
            ->method('findById')
            ->will($this->returnValue(null));
        $service = new AddressBookService($repositoryMock);
        $result = $service->delete(1);

        $this->assertFalse($result);
    }

    /**
     * @covers \AppBundle\Service\AddressBookInterface::delete
     */
    public function testDeleteSuccess()
    {
        $repositoryMock = $this->repositoryMock;
        $repositoryMock->expects($this->any())
            ->method('findById')
            ->will($this->returnValue($this->getEntityMock()));
        $repositoryMock->expects($this->any())
            ->method('delete')
            ->willReturn(true);
        $service = new AddressBookService($repositoryMock);
        $result = $service->delete(1);

        $this->assertTrue($result);
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    private function getRepositoryMock()
    {
        $repositoryMock = $this->getMockBuilder('AppBundle\Repository\AddressBookInterface')
            ->disableOriginalConstructor()
            ->setMethods([
                'findAll',
                'findById',
                'save',
                'delete',
            ])
            ->getMockForAbstractClass();

        return $repositoryMock;
    }

    /**
     * @return AddressBookEntity
     */
    private function getEntityMock()
    {
        $entity = new AddressBookEntity();
        $entity->setFirstName('First Name Test');
        $entity->setLastName('Last Name Test');
        $entity->setCity('Augsburg');
        $entity->setCountry('Germany');
        $entity->setZipCode('12345');

        return $entity;
    }
}
