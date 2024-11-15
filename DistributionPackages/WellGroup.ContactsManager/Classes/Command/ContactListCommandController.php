<?php

namespace WellGroup\ContactsManager\Command;

/*
 * This file is part of the WellGroup.ContactsManager package.
 */

use Neos\Flow\Persistence\Exception\IllegalObjectTypeException;
use WellGroup\ContactsManager\Domain\Model\Contact;
use WellGroup\ContactsManager\Domain\Model\ContactList;
use WellGroup\ContactsManager\Domain\Repository\ContactRepository;
use WellGroup\ContactsManager\Domain\Repository\ContactListRepository;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Cli\CommandController;

/**
 * @Flow\Scope("singleton")
 */
class ContactListCommandController extends CommandController {

    /**
     * @Flow\Inject
     * @var ContactListRepository
     */
    protected $contactListRepository;

    /**
     * @Flow\Inject
     * @var ContactRepository
     */
    protected $contactRepository;

    /**
     * A command to setup a contact list
     *
     * With this command you can kickstart a new contact list.
     *
     * @param string $contactListTitle the name of the contact list to create
     * @param bool $reset set this flag to remove all previously created contact list and contacts
     * @throws IllegalObjectTypeException
     */
    public function setupCommand(string $contactListTitle, bool $reset = false): void {
        if ($reset) {
            $this->contactListRepository->removeAll();
            $this->contactRepository->removeAll();
        }

        $contactList = new ContactList($contactListTitle);
        $contactList->setDescription('Juanma\'s Contact List');
        $this->contactListRepository->add($contactList);

        $contact = new Contact();
        $contact->setContactList($contactList);
        $contact->setName('Juanma');
        $contact->setEmail('jmca111197@gmail.com');
        $contact->setAddress('Balluta Bay');
        $contact->setPhone('653967952');
        $this->contactRepository->add($contact);

        $this->outputLine('Successfully created a contact list "%s"', [$contactListTitle]);
    }

}
