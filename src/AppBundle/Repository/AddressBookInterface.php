<?php

namespace AppBundle\Repository;

use AppBundle\Entity\AddressBook as AddressBookEntity;

interface AddressBookInterface
{
    /**
     * @return array|object[]
     */
    public function findAll();

    /**
     * @param int $id
     * @return object|null
     */
    public function findById(int $id);

    /**
     * @param AddressBookEntity $entity
     */
    public function save(AddressBookEntity $entity): void;

    /**
     * @param AddressBookEntity $entity
     */
    public function delete(AddressBookEntity $entity): void;
}
