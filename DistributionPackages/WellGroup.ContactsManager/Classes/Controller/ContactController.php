<?php

namespace WellGroup\ContactsManager\Controller;

use Neos\Flow\Mvc\Controller\ActionController;
use WellGroup\ContactsManager\Domain\Model\Contact;
use WellGroup\ContactsManager\Domain\Repository\ContactRepository;
use Neos\Flow\Annotations as Flow;

class ContactController extends ActionController {
    /**
     * @Flow\Inject
     * @var ContactRepository
     */
    protected $contactRepository;

    /**
     *
     *
     * @return void
     */
    public function listAction() {
        $contacts = $this->contactRepository->findAll();
        $this->view->assign('contacts', $contacts);
    }

    /**
     * @return void
     */
    public function newAction() {
    }

    /**
     * @return void
     */
    public function indexAction() {
        $this->view->assign('contacts', $this->contactRepository->findAll());
    }

    /**
     * @param \WellGroup\ContactsManager\Domain\Model\Contact $contact
     * @return void
     */
    public function showAction(Contact $contact) {
        $this->view->assign('contact', $contact);
    }

    /**
     * @param Contact $newContact
     * @return void
     * @throws \Neos\Flow\Mvc\Exception\StopActionException
     * @throws \Neos\Flow\Persistence\Exception\IllegalObjectTypeException
     */
    public function createAction(Contact $newContact): void {
        $this->contactRepository->add($newContact);
        $this->redirect('list');
    }

    /**
     * @param Contact $contact
     * @return void
     */
    public function editAction(Contact $contact): void {
        $this->view->assign('contact', $contact);
    }

    /**
     * @param Contact $contact
     * @return void
     * @throws \Neos\Flow\Mvc\Exception\StopActionException
     * @throws \Neos\Flow\Persistence\Exception\IllegalObjectTypeException
     */
    public function updateAction(Contact $contact): void {
        $this->contactRepository->update($contact);
        $this->redirect('list');
    }

    /**
     * @param Contact $contact
     * @return void
     * @throws \Neos\Flow\Mvc\Exception\StopActionException
     * @throws \Neos\Flow\Persistence\Exception\IllegalObjectTypeException
     */
    public function deleteAction(Contact $contact): void {
        $this->contactRepository->remove($contact);
        $this->redirect('list');
    }
}
