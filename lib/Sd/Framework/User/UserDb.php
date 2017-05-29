<?php
namespace Sd\Framework\User;

use Jml\Tools\Database\ConnectionSingleton;
use Sd\Elikia\Secretary\Secretary;
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
        JOIN grade
        USING (id_grade)
        WHERE login = :login AND password = :password";
        $stmt = $this->db->prepare($request);
        $stmt->execute(array(':login' => $login, ':password' => $password));
        $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        if ($row) {
            var_dump($row);
            die();
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
                $row['level_diploma'],
                $row['label'],
                $row['last_upgrade_date']
            );
            return $soldier;
        }
        $request = "SELECT *
        FROM secretary 
        WHERE login = :login AND password = :password";
        $stmt = $this->db->prepare($request);
        $stmt->execute(array(':login' => $login, ':password' => $password));
        $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);
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
        $stmt = $this->db->prepare($request);
        $stmt->execute(array(':login' => $login, ':password' => $password));
        $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);
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
        }
        return false;
    }
}