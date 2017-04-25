<?php
namespace Sd\Framework;

use Jml\Tools\Database\ConnectionSingleton;
use Sd\Framework\User\User;

/**
 * Class UserDb
 * @package Sd\Framework\User
 */
class UserDb
{
    /**
     * @var
     */
    protected $db;

    /**
     * Constructeur de la classe UserDb.
     */
    public function __construct()
    {
        $this->db = ConnectionSingleton::getInstance()->getConnection();
    }

    /**
     * Permet la récupération d'un utilisateur en bd.
     * @param $login
     * @param $password
     * @return bool|User
     */
    public function read($login, $password)
    {
        $request = "SELECT id_user, login, label
        FROM user 
        JOIN status USING (id_status) 
        WHERE login = :login AND password = :password";
        $stmt = $this->db->prepare($request);
        $stmt->execute(array(':login' => $login, ':password' => $password));
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($row) {
            $user= new User(
                $row['id_user'],
                $row['login'],
                $row['label']
            );
            return $user;
        }
        return false;
    }
}