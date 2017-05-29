<?php
namespace Sd\Elikia\Admin;

use Sd\Framework\AbstractClasses\AbstractUser;
use Sd\Framework\AbstractClasses\AbstractUserDb;

/**
 * Class AdminDb
 * @package Sd\Elikia\Admin
 */
class AdminDb extends AbstractUserDb
{
    /**
     * Constante permettant de stocker le nom de la table de la BD.
     */
    const TABLE_NAME = 'admin';

    /**
     * Constructeur de la classe SecretaryDb.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Permet de lire un admin en base de données.
     * @param $id
     * @return Admin
     * @throws \Exception
     */
    public function read($id)
    {
        $request = "SELECT * 
        FROM " . self::TABLE_NAME . " 
        WHERE id_admin = :id";
        $row = parent::SqlRequest($request, true, array(':id' => $id));
        if ($row == false) {
            throw new \Exception("Admin non trouvé en bd");
        }
        $row = $row[0];
        $admin = new Admin(
            $row['id_admin'],
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

    /**
     * @return mixed
     */
    public function readAll()
    {
        // TODO: Implement readAll() method.
    }

    /**
     * @param AbstractUser $user
     * @return mixed
     */
    public function register(AbstractUser $user)
    {
        // TODO: Implement register() method.
    }

    /**
     * @param AbstractUser $user
     * @return mixed
     */
    public function update(AbstractUser $user)
    {
        // TODO: Implement update() method.
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        // TODO: Implement delete() method.
    }
}