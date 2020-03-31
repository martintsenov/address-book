<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Service\AddressBookInterface as AddressBookServiceInterface;
use AppBundle\Entity\AddressBook as  AddressBookEntity;
use AppBundle\Form\AddressBook as AddressBookForm;

class AddressBookController extends Controller
{
    /**
     * @Route("/", name="address")
     *
     * @param Request $request
     * @param AddressBookServiceInterface $service
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request, AddressBookServiceInterface $service)
    {
        return $this->render('@App/address_book/index.html.twig');
    }

    /**
     * @Route("/address/add", name="address_add")
     *
     * @param Request $request
     * @param AddressBookServiceInterface $service
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request, AddressBookServiceInterface $service)
    {
        $form = $this->createForm(AddressBookForm::class, new AddressBookEntity());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $service->save($form);
            $this->addFlash("success", "New address added.");

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
     * @param AddressBookServiceInterface $service
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction(Request $request, AddressBookServiceInterface $service)
    {
        return $this->render('@App/address_book/list.html.twig', [
            'addressBooks' => $service->findAll(),
        ]);
    }

    /**
     * @Route("/address/edit/{id}", name="address_edit", requirements={"id"="\d+"})
     *
     * @param $id
     * @param Request $request
     * @param AddressBookServiceInterface $service
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction($id, Request $request, AddressBookServiceInterface $service)
    {
        $entity = $service->getById($id);

        if (!$entity) {
            $this->addFlash("danger", "Wrong url params.");

            return $this->redirectToRoute('address');
        }

        $form = $this->createForm(AddressBookForm::class, $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $service->save($form);
            $this->addFlash("success", "The address was updated.");

            return $this->redirectToRoute('address');
        }

        return $this->render('@App/address_book/edit.html.twig', [
            'form' => $form->createView(),
            'eid' => $id,
        ]);
    }

    /**
     * @Route("/address/delete/{id}", name="address_delete", requirements={"id"="\d+"})
     *
     * @param $id
     * @param AddressBookServiceInterface $service
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteAction($id, AddressBookServiceInterface $service)
    {
        $delete = $service->delete($id);

        if ($delete) {
            $this->addFlash("success", "The address was deleted.");
        } else {
            $this->addFlash("danger", "The address was not deleted. Please try again later.");
        }

        return $this->render('@App/address_book/index.html.twig');
    }
}
