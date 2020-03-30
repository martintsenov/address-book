<?php

namespace AppBundle\Service;

use AppBundle\Repository\AddressBookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;

class AddressBook implements AddressBookInterface
{
    /** @var AddressBookRepository */
    private $repo;
    /** @var EntityManagerInterface */
    private $entityManager;

    public function __construct(AddressBookRepository $repo, EntityManagerInterface $entityManager)
    {
        $this->repo = $repo;
        $this->entityManager = $entityManager;
    }

    /**
     * @param FormInterface $form
     * @return bool
     */
    public function add(FormInterface $form): bool
    {
        $entity = $form->getData();

        try {
            $this->entityManager->persist($entity);
            $this->entityManager->flush();

            return true;
        } catch (\Exception $e) {
            // log exception
            return false;
        }
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        try {
            return $this->repo->findAll();
        } catch (\Exception $e) {
            // log exception
            return [];
        }
    }
}
