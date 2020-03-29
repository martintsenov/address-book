<?php

namespace AppBundle\Service;

use Symfony\Component\Form\FormInterface;

interface AddressBookInterface
{
    public function add(FormInterface $form): bool;
    public function findAll(): array;
}
