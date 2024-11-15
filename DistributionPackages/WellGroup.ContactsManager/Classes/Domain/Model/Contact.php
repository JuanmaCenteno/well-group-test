<?php

namespace WellGroup\ContactsManager\Domain\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Neos\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Flow\Entity
 */
class Contact {

    /**
     * @Flow\Validate(type="NotEmpty")
     * @ORM\ManyToOne(inversedBy="contacts")
     * @var ContactList
     */
    protected $contactList;

    /**
     * @Flow\Validate(type="NotEmpty")
     * @Flow\Validate(type="StringLength", options={ "minimum"=3, "maximum"=80 })
     * @ORM\Column(length=80)
     * @var string
     */
    protected $name;

    /**
     * @Flow\Validate(type="Neos.Flow:EmailAddress")
     * @var string
     */
    protected $email;

    /**
     * @Flow\Validate(type="NotEmpty")
     * @Flow\Validate(type="StringLength", options={ "minimum"=9, "maximum"=12 })
     * @ORM\Column(length=12)
     * @var string
     */
    protected $phone;

    /**
     * @Flow\Validate(type="StringLength", options={ "maximum"=150 })
     * @ORM\Column(length=150)
     * @var string
     */
    protected $address;

    public function __construct() {
        $this->contactList = new ArrayCollection();
    }


    /**
     * @return ContactList
     */
    public function getContactList() {
        return $this->contactList;
    }

    /**
     * @param $contactList
     * @return void
     */
    public function setContactList($contactList) {
        $this->contactList = $contactList;
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param string $name
     * @return void
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * @param string $email
     * @return void
     */
    public function setEmail($email) {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPhone() {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return void
     */
    public function setPhone($phone) {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getAddress() {
        return $this->address;
    }

    /**
     * @param string $address
     * @return void
     */
    public function setAddress($address) {
        $this->address = $address;
    }
}
