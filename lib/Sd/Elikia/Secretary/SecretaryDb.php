<?php
namespace Sd\Elikia\Secretary;

use Sd\Framework\AbstractClasses\AbstractUser;
use Sd\Framework\AbstractClasses\AbstractUserDb;

/**
 * Class SecretaryDb
 * @package Sd\Elikia\Secretary
 */
class SecretaryDb extends AbstractUserDb
{
    /**
     * Constante permettant de stocker le nom de la table de la BD.
     */
    const TABLE_NAME = 'secretary';

    /**
     * Constructeur de la classe SecretaryDb.
     */
    public function __construct()
    {
        parent::__construct();
    }


    /**
     * Permet de lire un militaire en base de données.
     * @param $id
     * @return Secretary
     * @throws \Exception
     */
    public function read($id)
    {
        $request = "SELECT * 
        FROM " . self::TABLE_NAME . " 
        WHERE id_secretary = :id";
        $row = parent::SqlRequest($request, true, array(':id' => $id));
        if ($row == false) {
            throw new \Exception("Secrétaire non trouvé en bd");
        }
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

    /**
     * Permet de lire en base de données une liste de militaire.
     * @return array
     */
    public function readAll()
    {
        $request = "SELECT * 
        FROM " . self::TABLE_NAME;
        $list = array();
        $rows = parent::SqlRequest($request, true);
        if ($rows) {
            foreach ($rows as $row) {
                $list[] = new Secretary(
                    $row['id_secretary'],
                    $row['name'],
                    $row['surname'],
                    $row['birth_date'],
                    $row['address'],
                    $row['email'],
                    $row['login'],
                    $row['password']
                );
            }
        }
        return $list;
    }

    public function register(AbstractUser $user)
    {
        $request = "INSERT INTO " . self::TABLE_NAME . " " . $this->requestPart();
        parent::SqlRequest($request, false, $this->dataPart($user));
        $lastId = $this->db->lastInsertId();
        $user->setId($lastId);
        return $lastId;
    }

    public function update(AbstractUser $user)
    {
        $request = "UPDATE " . self::TABLE_NAME . " " . $this->requestPart() . " WHERE id_secretary=:id";
        $data = $this->dataPart($user);
        $data["id"] = $user->getId();
        return parent::SqlRequest($request, false, $data);
    }

    /**
     * Méthode interne pour la partie commune de la requête.
     * @return string
     */
    protected function requestPart()
    {
        $sql = "SET name=:name, surname=:surname, birth_date=:birthDate, address=:address, email=:email, login=:login, password=:password";
        return $sql;
    }

    protected function dataPart(AbstractUser $user)
    {
        return array(
            'name' => $user->getName(),
            'surname' => $user->getSurname(),
            'birthDate' => $user->getBirthDate(),
            'address' => $user->getAddress(),
            'email' => $user->getEmail(),
            'login' => $user->getLogin(),
            'password' => $user->getPassword()
        );
    }
    
    public function delete($id)
    {
        $request = "DELETE FROM " . self::TABLE_NAME . " WHERE id_secretary=:id";
        return parent::SqlRequest($request, false, array(':id' => $id));
    }
}