<?php

namespace AppBundle\Repository;

use AppBundle\Entity\AddressBook as AddressBookEntity;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class AddressBook implements AddressBookInterface
{
    /** @var EntityRepository */
    private $repository;

    /** @var EntityManagerInterface */
    private $entityManager;

    /**
     * AddressBookRepository constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(AddressBookEntity::class);
    }

    /**
     * @return array|object[]
     */
    public function findAll()
    {
        return $this->repository->findAll();
    }

    /**
     * @param int $id
     * @return object|null
     */
    public function findById(int $id)
    {
        return $this->repository->find($id);
    }

    /**
     * @param AddressBookEntity $entity
     */
    public function save(AddressBookEntity $entity): void
    {
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    /**
     * @param AddressBookEntity $entity
     */
    public function delete(AddressBookEntity $entity): void
    {
        $this->entityManager->remove($entity);
        $this->entityManager->flush();
    }
}
