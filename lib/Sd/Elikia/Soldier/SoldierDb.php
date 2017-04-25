<?php
namespace Sd\Elikia\Soldier;

use Sd\Framework\AbstractClasses\AbstractPerson;
use Sd\Framework\AbstractClasses\AbstractPersonDb;

/**
 * Class SoldierDb
 * @package Sd\Elikia\Soldier
 */
class SoldierDb extends AbstractPersonDb
{
    /**
     * Constante permettant de stocker le nom de la table de la BD.
     */
    const TABLE_NAME = 'soldier';

    /**
     * Constructeur de la classe SoldierDb.
     */
    public function __construct()
    {
        parent::__construct();
    }


    /**
     * Permet de lire un militaire en base de données.
     * @param $id
     * @return Soldier
     * @throws \Exception
     */
    public function read($id)
    {
        $request = "SELECT * 
        FROM " . self::TABLE_NAME . " 
        WHERE id_soldier = :id";
        $row = parent::SqlRequest($request, true, array(':id' => $id));
        if ($row == false) {
            throw new \Exception("Militaire non trouvé en bd");
        }
        $row = $row[0];
        $soldier = new Soldier(
            $row['id_soldier'],
            $row['name'],
            $row['surname'],
            $row['birth_date'],
            $row['address'],
            $row['email'],
            $row['gender'],
            $row['admission_date'],
            $row['diploma'],
            $row['grade'],
            $row['last_upgrade_date']
        );
        return $soldier;
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
                $list[] = new Soldier(
                    $row['id_soldier'],
                    $row['name'],
                    $row['surname'],
                    $row['birth_date'],
                    $row['address'],
                    $row['email'],
                    $row['gender'],
                    $row['admission_date'],
                    $row['dilpoma'],
                    $row['grade'],
                    $row['last_upgrade_date']
                );
            }
        }
        return $list;
    }

    public function register(AbstractPerson $person)
    {
        $request = "INSERT INTO " . self::TABLE_NAME . " " . $this->requestPart();
        parent::SqlRequest($request, false, $this->dataPart($person));
        $lastId = $this->db->lastInsertId();
        $person->setId($lastId);
        return $lastId;
    }

    public function update(AbstractPerson $person)
    {
        $request = "UPDATE " . self::TABLE_NAME . " " . $this->requestPart() . " WHERE id_soldier=:id";
        $data = $this->dataPart($person);
        $data["id"] = $person->getId();
        var_dump($data);
        return parent::SqlRequest($request, false, $data);
    }

    /**
     * Méthode interne pour la partie commune de la requête.
     * @return string
     */
    protected function requestPart()
    {
        $sql = "SET name=:name, surname=:surname, birth_date=:birthDate, address=:address, email=:email, gender=:gender, admission_date=:admissionDate, diploma=:diploma, grade=:grade, last_upgrade_date=:lastUpgradeDate";
        return $sql;
    }

    protected function dataPart(AbstractPerson $person)
    {
        return array(
            'name' => $person->getName(),
            'surname' => $person->getSurname(),
            'birthDate' => $person->getBirthDate(),
            'address' => $person->getAddress(),
            'email' => $person->getEmail(),
            'gender' => $person->getGender(),
            'admissionDate' => $person->getAdmissionDate(),
            'diploma' => $person->getDiploma(),
            'grade' => $person->getGrade(),
            'lastUpgradeDate' => $person->getLastUpgradeDate()
        );
    }
    
    public function delete($id)
    {
        $request = "DELETE FROM " . self::TABLE_NAME . " WHERE id_soldier=:id";
        return parent::SqlRequest($request, false, array(':id' => $id));
    }
}