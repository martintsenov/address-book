<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\AddressBook as AddressBookEntity;

class AddressBookRepository
{
    /** @var EntityRepository */
    private $repository;

    /**
     * AddressBookRepository constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository(AddressBookEntity::class);
    }

    /**
     * @return array|object[]
     */
    public function findAll()
    {
        return $this->repository->findAll();
    }
}
