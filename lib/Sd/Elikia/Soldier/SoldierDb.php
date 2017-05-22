<?php
namespace Sd\Elikia\Soldier;

use Sd\Framework\AbstractClasses\AbstractUser;
use Sd\Framework\AbstractClasses\AbstractUserDb;

/**
 * Class SoldierDb
 * @package Sd\Elikia\Soldier
 */
class SoldierDb extends AbstractUserDb
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
     * Permet de récupérer la liste des grades
     */
    public function getAllGrades()
    {
        $request = "SELECT *
        FROM " . self::TABLE_NAME;
        $list = array();
        $rows = parent::SqlRequest($request, true);
        if ($rows) {
            foreach ($rows as $row) {
                $list[] = new Grade(
                    $row['id_grade'],
                    $row['label'],
                    $row['years_of_service'],
                    $row['lower_grade'],
                    $row['lower_grade_years']
                );
            }
        }
        return $list;
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
        JOIN grade
        USING (id_grade)
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
            $row['login'],
            $row['password'],
            $row['gender'],
            $row['admission_date'],
            $row['diploma'],
            $row['label'],
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
        FROM " . self::TABLE_NAME . "
        JOIN grade
        USING (id_grade)";
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
                    $row['login'],
                    $row['password'],
                    $row['gender'],
                    $row['admission_date'],
                    $row['diploma'],
                    $row['label'],
                    $row['last_upgrade_date']
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
        $request = "UPDATE " . self::TABLE_NAME . " " . $this->requestPart() . " WHERE id_soldier=:id";
        $data = $this->dataPart($user);
        $data["id"] = $user->getId();
        var_dump($data);
        return parent::SqlRequest($request, false, $data);
    }

    /**
     * Méthode interne pour la partie commune de la requête.
     * @return string
     */
    protected function requestPart()
    {
        $sql = "SET name=:name, surname=:surname, birth_date=:birthDate, address=:address, email=:email, login=:login, password=:password, gender=:gender, admission_date=:admissionDate, diploma=:diploma, grade=:grade, last_upgrade_date=:lastUpgradeDate";
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
            'password' => $user->getPassword(),
            'gender' => $user->getGender(),
            'admissionDate' => $user->getAdmissionDate(),
            'diploma' => $user->getDiploma(),
            'grade' => $user->getGrade(),
            'lastUpgradeDate' => $user->getLastUpgradeDate()
        );
    }
    
    public function delete($id)
    {
        $request = "DELETE FROM " . self::TABLE_NAME . " WHERE id_soldier=:id";
        return parent::SqlRequest($request, false, array(':id' => $id));
    }
}