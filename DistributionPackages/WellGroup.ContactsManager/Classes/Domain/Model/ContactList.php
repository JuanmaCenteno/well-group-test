<?php

namespace WellGroup\ContactsManager\Domain\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Neos\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Flow\Entity
 */
class ContactList {

    /**
     * @Flow\Validate(type="NotEmpty")
     * @Flow\Validate(type="StringLength", options={ "minimum"=3, "maximum"=80 })
     * @ORM\Column(length=80)
     * @var string
     */
    protected string $title;

    /**
     * @Flow\Validate(type="StringLength", options={ "maximum"=150 })
     * @ORM\Column(length=150)
     * @var string
     */
    protected string $description;

    /**
     * The posts contained in this blog
     *
     * @ORM\OneToMany(mappedBy="contactList")
     * @ORM\OrderBy({"name" = "ASC"})
     * @var Collection<Contact>
     */
    protected Collection $contacts;

    public function __construct(string $title, string $description = '') {
        $this->title = $title;
        $this->description = $description;
        $this->contacts = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getTitle(): string {
        return $this->title;
    }

    /**
     * @param string $title
     * @return void
     */
    public function setTitle($title): void {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription(): string {
        return $this->description;
    }

    /**
     * @param string $description
     * @return void
     */
    public function setDescription($description): void {
        $this->description = $description;
    }

    /**
     * @return Collection
     */
    public function getContacts(): Collection {
        return $this->contacts;
    }

    /**
     * @param Collection $contacts
     * @return void
     */
    public function setContacts(Collection $contacts): void {
        $this->contacts = $contacts;
    }
}
