<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Service\AddressBookInterface;
use AppBundle\Entity\AddressBook as  AddressBookEntity;
use AppBundle\Form\AddressBook as AddressBookForm;

class AddressBookController extends Controller
{
    /**
     * @Route("/", name="address")
     *
     * @param Request $request
     * @param AddressBookInterface $service
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request, AddressBookInterface $service)
    {
        return $this->render('@App/address_book/index.html.twig');
    }

    /**
     * @Route("/address/add", name="address_add")
     *
     * @param Request $request
     * @param AddressBookInterface $service
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request, AddressBookInterface $service)
    {
        $form = $this->createForm(AddressBookForm::class, new AddressBookEntity());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $service->add($form);

            return $this->redirectToRoute('address');
        }

        return $this->render('@App/address_book/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/address/list", name="address_list")
     *
     * @param Request $request
     * @param AddressBookInterface $service
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction(Request $request, AddressBookInterface $service)
    {
        return $this->render('@App/address_book/list.html.twig', [
            'addressBooks' => $service->findAll(),
        ]);
    }

    /**
     * @Route("/address/edit/{id}", name="address_edit")
     *
     * @param $id
     * @param AddressBookInterface $service
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction($id, AddressBookInterface $service)
    {
        return $this->render('@App/address_book/index.html.twig');
    }

    /**
     * @Route("/address/delete/{id}", name="address_delete")
     *
     * @param $id
     * @param AddressBookInterface $service
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteAction($id, AddressBookInterface $service)
    {
        return $this->render('@App/address_book/index.html.twig');
    }
}
