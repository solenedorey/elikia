<?php
namespace Sd\Framework\AbstractClasses;

/**
 * Class AbstractPerson
 * @package Sd\Framework\AbstractClasses
 */
class AbstractPerson
{
    /**
     * Identifiant de la personne
     * @var int
     */
    protected $id;
    
    /**
     * Prénom de la personne
     * @var string
     */
    protected $name;
    
    /**
     * Nom de la personne
     * @var string
     */
    protected $surname;
    
    /**
     * Année de naissance de la personne
     * @var string
     */
    protected $birthDate;

    /**
     * Adresse de la personne
     * @var string
     */
    protected $address;

    /**
     * Email de la personne
     * @var string
     */
    protected $email;

    /**
     * AbstractPerson constructor.
     * @param $id
     * @param $name
     * @param $surname
     * @param $birthDate
     * @param $address
     * @param $email
     */
    public function __construct($id, $name, $surname, $birthDate, $address, $email)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->birthDate = $birthDate;
        $this->address = $address;
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param mixed $surname
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    /**
     * @return mixed
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @param mixed $birthDate
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }
}
