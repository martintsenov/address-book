<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Service\AddressBookInterface as AddressBookService;
use AppBundle\Entity\AddressBook as  AddressBookEntity;
use AppBundle\Form\AddressBook as AddressBookForm;

class AddressBookController extends Controller
{
    /**
     * @Route("/", name="address")
     *
     * @param Request $request
     * @param AddressBookService $service
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request, AddressBookService $service)
    {
        return $this->render('@App/address_book/index.html.twig', [
            'param' => __METHOD__ . ' and service ' . get_class($service),
        ]);
    }

    /**
     * @Route("/address/add", name="address_add")
     *
     * @param Request $request
     * @param AddressBookService $service
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request, AddressBookService $service)
    {
        $form = $this->createForm(AddressBookForm::class, new AddressBookEntity());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $service->add($form);

            return $this->redirectToRoute('address');
        }

        return $this->render('@App/address_book/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/address/list", name="address_list")
     *
     * @param Request $request
     * @param AddressBookService $service
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction(Request $request, AddressBookService $service)
    {
        return $this->render('@App/address_book/list.html.twig', [
            'addressBooks' => $service->findAll(),
        ]);
    }
}
