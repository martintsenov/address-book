<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Service\AddressBook as AddressBookService;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="address")
     */
    public function indexAction(Request $request, AddressBookService $service)
    {
        // replace this example code with whatever you need
        return $this->render('@App/address_book/index.html.twig', [
            'param' => __METHOD__ . ' and service ' . $service->test(),
        ]);
    }

    /**
     * @Route("/address/add", name="address_add")
     */
    public function addAddressAction(Request $request, AddressBookService $service)
    {
        // replace this example code with whatever you need
        return $this->render('@App/address_book/index.html.twig', [
            'param' => __METHOD__ . ' and service ' . $service->test(),
        ]);
    }
}
