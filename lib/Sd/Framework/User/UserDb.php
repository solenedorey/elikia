<?php
namespace Sd\Framework\User;

use Jml\Tools\Database\ConnectionSingleton;
use Sd\Elikia\Soldier\Soldier;
use Sd\Framework\AbstractClasses\AbstractUser;

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
     * Permet la récupération d'un utilisateur connecté en bd.
     * @param $login
     * @param $password
     * @return bool|AbstractUser
     */
    public function checkUser($login, $password)
    {
        $request = "SELECT *
        FROM soldier 
        WHERE login = :login AND password = :password";
        $stmt = $this->db->prepare($request);
        $stmt->execute(array(':login' => $login, ':password' => $password));
        $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        if ($row) {
            $row = $row[0];
            $soldier = new Soldier(
                $row['id_soldier'],
                $row['name'],
                $row['surname'],
                $row['birth_date'],
                $row['address'],
                $row['email'],
                $row['login'],
                $row['password'],
                $row['gender'],
                $row['admission_date'],
                $row['diploma'],
                $row['grade'],
                $row['last_upgrade_date']
            );
            return $soldier;
        }
        /*$request = "SELECT *
        FROM secretary 
        WHERE login = :login AND password = :password";
        $row = $this->SqlRequest($request, true, array(':login' => $login, ':password' => $password));
        if ($row) {
            $row = $row[0];
            $secretary = new Secretary(
                $row['id_secretary'],
                $row['name'],
                $row['surname'],
                $row['birth_date'],
                $row['address'],
                $row['email'],
                $row['login'],
                $row['password']
            );
            return $secretary;
        }
        $request = "SELECT *
        FROM admin 
        WHERE login = :login AND password = :password";
        $row = $this->SqlRequest($request, true, array(':login' => $login, ':password' => $password));
        if ($row) {
            $row = $row[0];
            $admin = new Admin(
                $row['id_secretary'],
                $row['name'],
                $row['surname'],
                $row['birth_date'],
                $row['address'],
                $row['email'],
                $row['login'],
                $row['password']
            );
            return $admin;
        }*/
        return false;
    }
}