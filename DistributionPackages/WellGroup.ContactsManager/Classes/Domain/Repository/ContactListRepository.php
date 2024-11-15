<?php

namespace WellGroup\ContactsManager\Domain\Repository;

/*                                                                        *
 * This script belongs to the Flow package "Acme.Blog".                   *
 *                                                                        *
 *                                                                        */

use WellGroup\ContactsManager\Domain\Model\ContactList;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Persistence\Repository;

/**
 * @Flow\Scope("singleton")
 */
class ContactListRepository extends Repository {

    /**
     * Finds the active ContactList.
     *
     * For now, only one ContactList is supported anyway so we just assume that only one
     * ContactList object resides in the ContactList Repository.
     *
     * @return ContactList|null The active blog or null if none exists
     */
    public function findActive(): ?ContactList {
        $query = $this->createQuery();
        return $query->execute()->getFirst();
    }

}
