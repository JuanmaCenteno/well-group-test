<?php
/**
 * Repository of Contacts. This class is dedicated to provide the
 * functions to interact with Contacts.
 */

namespace WellGroup\ContactsManager\Domain\Repository;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Persistence\Exception\InvalidQueryException;
use Neos\Flow\Persistence\Repository;
use WellGroup\ContactsManager\Domain\Model\ContactList;
use WellGroup\ContactsManager\Domain\Model\Contact;
use Neos\Flow\Persistence\QueryInterface;
use Neos\Flow\Persistence\QueryResultInterface;

/**
 * class ContactRepository
 *
 * @Flow\Scope("singleton")
 */
class ContactRepository extends Repository {

    /**
     * Finds contacts by the specified contact list
     *
     * @param ContactList $contactList The contact list the contact must refer to
     * @return QueryResultInterface The contacts
     */
    public function findByBlog(ContactList $contactList): QueryResultInterface {
        $query = $this->createQuery();
        return
            $query->matching(
                $query->equals('contactList', $contactList)
            )
                ->setOrderings(array('name' => QueryInterface::ORDER_DESCENDING))
                ->execute();
    }

    /**
     * Finds the previous of the given contact
     *
     * @param Contact $contact The reference contact
     * @return Contact|null The previous contact or null if the given $contact is the first one
     * @throws InvalidQueryException
     */
    public function findPrevious(Contact $contact): ?Contact {
        $query = $this->createQuery();
        return
            $query->matching(
                $query->logicalAnd([
                    $query->equals('contactList', $contact->getContactList()),
                    $query->lessThan('name', $contact->getName())
                ])
            )
                ->setOrderings(array('name' => QueryInterface::ORDER_ASCENDING))
                ->execute()
                ->getFirst();
    }

    /**
     * Finds the contact next to the given contact
     *
     * @param Contact $contact The reference contact
     * @return Contact|null The next contact or null if the given $contact is the last one
     * @throws InvalidQueryException
     */
    public function findNext(Contact $contact): ?Contact {
        $query = $this->createQuery();
        return
            $query->matching(
                $query->logicalAnd([
                    $query->equals('contactList', $contact->getContactList()),
                    $query->greaterThan('name', $contact->getName())
                ])
            )
                ->setOrderings(array('date' => QueryInterface::ORDER_DESCENDING))
                ->execute()
                ->getFirst();
    }
}
