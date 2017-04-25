<?php
namespace Sd\Framework\User;

/**
 * Class User
 * @package Sd\Framework\User
 */
class User
{
    /**
     * @var
     */
    private $id;

    /**
     * @var
     */
    private $login;

    /**
     * @var
     */
    private $status;

    /**
     * Constructeur de la classe User.
     * @param $id
     * @param $login
     * @param $status
     */
    public function __construct($id, $login, $status)
    {
        $this->id = $id;
        $this->login = $login;
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
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }


}