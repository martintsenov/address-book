<?php

namespace AppBundle\Service;

use AppBundle\Repository\AddressBookInterface as  AddressBookRepositoryInterface;
use AppBundle\Entity\AddressBook as AddressBookEntity;
use Doctrine\ORM\Query\Printer;
use Symfony\Component\Form\FormInterface;

class AddressBook implements AddressBookInterface
{
    /** @var AddressBookRepositoryInterface */
    private $repository;

    public function __construct(AddressBookRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param FormInterface $form
     * @return bool
     */
    public function save(FormInterface $form): bool
    {
        $entity = $form->getData();

        try {
            $this->repository->save($entity);

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
            return $this->repository->findAll();
        } catch (\Exception $e) {
            // log exception
            return [];
        }
    }

    /**
     * @param int $id
     * @return AddressBookEntity|null
     */
    public function getById(int $id): ?AddressBookEntity
    {
        try {
            return $this->repository->findById($id);
        } catch (\Exception $e) {
            // log exception
            return null;
        }
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $entity = $this->repository->findById($id);

        if (!$entity) {
            return false;
        }

        try {
            $this->repository->delete($entity);

            return true;
        } catch (\Exception $e) {
            // log exception
            return false;
        }
    }
}
