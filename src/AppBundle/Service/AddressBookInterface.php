<?php

namespace AppBundle\Service;

use Symfony\Component\Form\FormInterface;

interface AddressBookInterface
{
    /**
     * @param FormInterface $form
     * @return bool
     */
    public function add(FormInterface $form): bool;

    /**
     * @return array
     */
    public function findAll(): array;
}
