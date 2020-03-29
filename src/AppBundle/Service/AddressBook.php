<?php

namespace AppBundle\Service;

use AppBundle\Repository\AddressBookRepository;

class AddressBook
{
    private $repo;

    public function __construct(AddressBookRepository $repo)
    {
        $this->repo = $repo;
    }

    public function test()
    {
        return 'service class is ' . get_class($this->repo);
    }
}
