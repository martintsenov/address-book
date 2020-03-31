<?php

namespace AppBundle\Service;

use AppBundle\Entity\AddressBook as AddressBookEntity;
use Symfony\Component\Form\FormInterface;

interface AddressBookInterface
{
    /**
     * @param FormInterface $form
     * @return bool
     */
    public function save(FormInterface $form): bool;

    /**
     * @return array
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return AddressBookEntity|null
     */
    public function getById(int $id): ?AddressBookEntity;

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}
