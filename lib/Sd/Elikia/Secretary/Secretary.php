<?php
namespace Sd\Elikia\Secretary;

use Sd\Framework\AbstractClasses\AbstractUser;

/**
 * Class Secretary
 * @package Sd\Elikia\Secretary
 */
class Secretary extends AbstractUser
{
    /**
     * Secretary constructor.
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
        parent::__construct($id, $name, $surname, $birthDate, $address, $email, $login, $password);
        $this->status = SECRETARY;
    }

    /**
     * Permet d'instancier un nouveau secrétaire "vide".
     * @return Secretary
     */
    public static function createUnknownSecretary()
    {
        return new self(null, '', '', '', '', '', '', '');
    }

    /**
     * Permet d'instancier un nouveau secrétaire depuis les valeurs d'un tableau.
     * @param $data
     * @return Secretary
     */
    public static function createFromArray($data)
    {
        $name = isset($data['name']) && $data['name'] != '' ? $data['name'] : '';
        $surname = isset($data['surname']) && $data['surname'] != '' ? $data['surname'] : '';
        $birthDate = isset($data['birthDate']) && $data['birthDate'] != '' ? $data['birthDate'] : '';
        $address = isset($data['address']) && $data['address'] != '' ? $data['address'] : '';
        $email = isset($data['email']) && $data['email'] != '' ? $data['email'] : '';
        $login = isset($data['login']) && $data['login'] != '' ? $data['login'] : '';
        $password = isset($data['password']) && $data['password'] != '' ? $data['password'] : '';
        return new self(null, $name, $surname, $birthDate, $address, $email, $login, $password);
    }

    /**
     * Permet de modifier les attributs d'un Militaire depuis les valeurs d'un tableau.
     * @param $data
     */
    public function updateFromArray($data)
    {
        if (isset($data['name'])) {
            $this->setName($data['name']);
        }
        if (isset($data['surname'])) {
            $this->setSurname($data['surname']);
        }
        if (isset($data['birthDate'])) {
            $this->setBirthDate($data['birthDate']);
        }
        if (isset($data['address'])) {
            $this->setAddress($data['address']);
        }
        if (isset($data['email'])) {
            $this->setEmail($data['email']);
        }
        if (isset($data['login'])) {
            $this->setLogin($data['login']);
        }
        if (isset($data['password'])) {
            $this->setPassword($data['password']);
        }
    }
}