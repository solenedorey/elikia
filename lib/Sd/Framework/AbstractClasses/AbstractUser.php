<?php
namespace Sd\Framework\AbstractClasses;

/**
 * Class AbstractUser
 * @package Sd\Framework\AbstractClasses
 */
class AbstractUser
{
    /**
     * @var
     */
    protected $status;
    
    /**
     * Identifiant de l'utilisateur
     * @var int
     */
    protected $id;
    
    /**
     * Prénom de l'utilisateur
     * @var string
     */
    protected $name;
    
    /**
     * Nom de l'utilisateur
     * @var string
     */
    protected $surname;
    
    /**
     * Année de naissance de l'utilisateur
     * @var string
     */
    protected $birthDate;

    /**
     * Adresse de l'utilisateur
     * @var string
     */
    protected $address;

    /**
     * Email de l'utilisateur
     * @var string
     */
    protected $email;

    /**
     * @var
     */
    private $login;

    /**
     * @var
     */
    private $password;

    /**
     * AbstractPerson constructor.
     * @param $id
     * @param $name
     * @param $surname
     * @param $birthDate
     * @param $address
     * @param $email
     * @param $login
     * @param $password
     */
    public function __construct($id, $name, $surname, $birthDate, $address, $email, $login, $password)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->birthDate = $birthDate;
        $this->address = $address;
        $this->email = $email;
        $this->login = $login;
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
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

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
}
