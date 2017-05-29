<?php
namespace Sd\Elikia\Admin;

use Sd\Framework\AbstractClasses\AbstractUser;

/**
 * Class Admin
 * @package Sd\Elikia\Admin
 */
class Admin extends AbstractUser
{
    /**
     * Admin constructor.
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
        $this->status = ADMIN;
    }
}