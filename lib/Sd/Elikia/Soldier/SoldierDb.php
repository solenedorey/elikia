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
        FROM grade ORDER BY label ASC";
        $list = array();
        $rows = parent::SqlRequest($request, true);
        if ($rows) {
            foreach ($rows as $row) {
                $list[] = new Grade(
                    $row['id_grade'],
                    $row['label'],
                    $row['years_of_service'],
                    $row['lower_grade'],
                    $row['lower_grade_years'],
                    $row['level_diploma_required'],
                    $row['age_required_to_retire'],
                    $row['total_years_to_retire']
                );
            }
        }
        return $list;
    }

    /**
     * Permet de récupérer l'id d'un grade
     */
    public function getGrade($label)
    {
        $request = "SELECT *
        FROM grade WHERE label = :label";
        $row = parent::SqlRequest($request, true, array(':label' => $label));
        if ($row == false) {
            throw new \Exception("Grade non trouvé en bd");
        }
        $row = $row[0];
        $grade = new Grade(
            $row['id_grade'],
            $row['label'],
            $row['years_of_service'],
            $row['lower_grade'],
            $row['lower_grade_years'],
            $row['level_diploma_required'],
            $row['age_required_to_retire'],
            $row['total_years_to_retire']
        );
        return $grade;
    }

    public function soldiersLikelyToRetire($period)
    {

    }

    public function soldiersLikelyToUpgrade($aimedGrade)
    {
        $grade = $this->getGrade($aimedGrade);
        $yearsOfServiceAsked = $grade->getYearsOfService();
        $gradeAskedId = $this->getGrade($grade->getLowerGrade())->getId();
        $yearsOfGradeAsked = $grade->getYearsOfLowerGrade();
        $diplomaRequired = $grade->getDiplomaType();
        $request = "SELECT * 
        FROM " . self::TABLE_NAME . "
        WHERE id_grade = :gradeAskedId AND TIMESTAMPDIFF(YEAR, admission_date, DATE(NOW())) >= :yearsOfServiceAsked AND TIMESTAMPDIFF(YEAR, last_upgrade_date, DATE(NOW())) >= :yearsOfGradeAsked AND diploma = :diplomaRequired";
        $list = array();
        $rows = parent::SqlRequest($request, true, array(':gradeAskedId' => $gradeAskedId, ':yearsOfServiceAsked' => $yearsOfServiceAsked, ':yearsOfGradeAsked' => $yearsOfGradeAsked, ':diplomaRequired' => $diplomaRequired));
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
                    $row['level_diploma'],
                    $row['label'],
                    $row['last_upgrade_date']
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
            $row['level_diploma'],
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
                    $row['level_diploma'],
                    $row['label'],
                    $row['last_upgrade_date']
                );
            }
        }
        return $list;
    }

    public function register(AbstractUser $user)
    {
        $labelGrade = $user->getGrade();
        $idGrade = $this->getGrade($labelGrade)->getId();
        $request = "INSERT INTO " . self::TABLE_NAME . " " . $this->requestPart();
        parent::SqlRequest($request, false, $this->dataPart($user, $idGrade));
        $lastId = $this->db->lastInsertId();
        $user->setId($lastId);
        return $lastId;
    }

    public function update(AbstractUser $user)
    {
        $labelGrade = $user->getGrade();
        $idGrade = $this->getGrade($labelGrade)->getId();
        $request = "UPDATE " . self::TABLE_NAME . " " . $this->requestPart() . " WHERE id_soldier=:id";
        $data = $this->dataPart($user, $idGrade);
        $data["id"] = $user->getId();
        return parent::SqlRequest($request, false, $data);
    }

    /**
     * Méthode interne pour la partie commune de la requête.
     * @return string
     */
    protected function requestPart()
    {
        $sql = "SET name=:name, surname=:surname, birth_date=:birthDate, address=:address, email=:email, login=:login, password=:password, gender=:gender, admission_date=:admissionDate, level_diploma=:diploma, id_grade=:idGrade, last_upgrade_date=:lastUpgradeDate";
        return $sql;
    }

    protected function dataPart(AbstractUser $user, $idGrade)
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
            'idGrade' => $idGrade,
            'lastUpgradeDate' => $user->getLastUpgradeDate()
        );
    }

    public function delete($id)
    {
        $request = "DELETE FROM " . self::TABLE_NAME . " WHERE id_soldier=:id";
        return parent::SqlRequest($request, false, array(':id' => $id));
    }
}