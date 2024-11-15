<?php

namespace WellGroup\ContactsManager\Controller;

use Neos\Flow\Mvc\Controller\ActionController;
use WellGroup\ContactsManager\Domain\Model\Contact;
use WellGroup\ContactsManager\Domain\Repository\ContactListRepository;
use WellGroup\ContactsManager\Domain\Repository\ContactRepository;
use Neos\Flow\Mvc\View\ViewInterface;
use Neos\Flow\Annotations as Flow;

class ContactController extends ActionController {

    /**
     * @Flow\Inject
     * @var ContactListRepository
     */
    protected $contactListRepository;

    /**
     * @Flow\Inject
     * @var ContactRepository
     */
    protected ContactRepository $contactRepository;

    protected function initializeView(ViewInterface $view): void {
        $contactList = $this->contactListRepository->findActive();
        $this->view->assign('contactList', $contactList);
    }

    public function indexAction(): void {
        $this->view->assign('contacts', $this->contactRepository->findAll());
    }

    public function showAction(Contact $contact): void {
        $this->view->assign('contact', $contact);
    }

    public function newAction(): void {
        $this->view->assign('newContact', new Contact());
    }

    public function createAction(Contact $newContact): void {
        $this->contactRepository->add($newContact);
        $this->addFlashMessage('Contact created successfully.');
        $this->redirect('index');
    }

    public function editAction(Contact $contact): void {
        $this->view->assign('contact', $contact);
    }


    public function updateAction(Contact $contact): void {
        $this->contactRepository->update($contact);
        $this->addFlashMessage('Contact updated successfully.');
        $this->redirect('index');
    }

    public function deleteAction(Contact $contact): void {
        $this->contactRepository->remove($contact);
        $this->addFlashMessage('Contact deleted successfully.');
        $this->redirect('index');
    }
}
