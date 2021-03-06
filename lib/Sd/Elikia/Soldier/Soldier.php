<?php
namespace Sd\Elikia\Soldier;

use Sd\Framework\AbstractClasses\AbstractUser;

/**
 * Class Soldier
 * @package Sd\Elikia\Soldier
 */
class Soldier extends AbstractUser
{
    /**
     * Sexe du militaire
     * @var bool
     */
    private $gender;

    /**
     * Date d'entrée dans l'armée du militaire
     * @var string
     */
    private $admissionDate;

    /**
     * Diplôme du militaire
     * @var string
     */
    private $diploma;

    /**
     * Grade du militaire
     * @var string
     */
    private $grade;

    /**
     * Date d'obtention du grade actuel du militaire
     * @var string
     */
    private $lastUpgradeDate;

    /**
     * Soldier constructor.
     * @param $id
     * @param $name
     * @param $surname
     * @param $birthDate
     * @param $address
     * @param $email
     * @param $login
     * @param $password
     * @param $gender
     * @param $admissionDate
     * @param $diploma
     * @param $grade
     * @param $lastUpgradeDate
     */
    public function __construct($id, $name, $surname, $birthDate, $address, $email, $login, $password, $gender, $admissionDate, $diploma, $grade, $lastUpgradeDate)
    {
        parent::__construct($id, $name, $surname, $birthDate, $address, $email, $login, $password);
        $this->status = SOLDIER;
        $this->gender = $gender;
        $this->admissionDate = $admissionDate;
        $this->diploma = $diploma;
        $this->grade = $grade;
        $this->lastUpgradeDate = $lastUpgradeDate;
    }

    /**
     * Permet de retourner l'âge du soldat.
     * @param $period
     * @return false|string
     */
    public function getAge($period = 0) {
        var_dump($period);
        $age = date('Y', strtotime('+' . $period . ' month', strtotime("now"))) - date('Y', strtotime($this->getBirthDate()));
        if (date('md', strtotime('+' . $period . ' month', strtotime("now"))) < date('md', strtotime($this->getBirthDate()))) {
            return $age - 1;
        }
        var_dump($age);
        return $age;
    }

    /**
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * @return string
     */
    public function getAdmissionDate()
    {
        return $this->admissionDate;
    }

    /**
     * @param string $admissionDate
     */
    public function setAdmissionDate($admissionDate)
    {
        $this->admissionDate = $admissionDate;
    }

    /**
     * Permet de retourner le nombre d'année de service.
     * @param $period
     * @return false|string
     */
    public function getYearsOfService($period) {
        $years = date('Y', strtotime('+' . $period . ' month', strtotime("now"))) - date('Y', strtotime($this->getAdmissionDate()));
        if (date('md', strtotime('+' . $period . ' month', strtotime("now"))) < date('md', strtotime($this->getAdmissionDate()))) {
            return $years - 1;
        }
        return $years;
    }

    /**
     * @return string
     */
    public function getDiploma()
    {
        return $this->diploma;
    }

    /**
     * @param string $diploma
     */
    public function setDiploma($diploma)
    {
        $this->diploma = $diploma;
    }

    /**
     * @return string
     */
    public function getGrade()
    {
        return $this->grade;
    }

    /**
     * @param string $grade
     */
    public function setGrade($grade)
    {
        $this->grade = $grade;
    }

    /**
     * @return string
     */
    public function getLastUpgradeDate()
    {
        return $this->lastUpgradeDate;
    }

    /**
     * @param string $lastUpgradeDate
     */
    public function setLastUpgradeDate($lastUpgradeDate)
    {
        $this->lastUpgradeDate = $lastUpgradeDate;
    }

    /**
     * Permet d'instancier un nouveau Militaire "vide".
     * @return Soldier
     */
    public static function createUnknownSoldier()
    {
        return new self(null, '', '', '', '', '', '', '', '', '', '', '', '');
    }

    /**
     * Permet d'instancier un nouveau Militaire depuis les valeurs d'un tableau.
     * @param $data
     * @return Soldier
     */
    public static function createFromArray($data)
    {
        $name = isset($data['name']) && $data['name'] != '' ? $data['name'] : '';
        $surname = isset($data['surname']) && $data['surname'] != '' ? $data['surname'] : '';
        $birthDate = isset($data['birthDate']) && $data['birthDate'] != '' ? $data['birthDate'] : '';
        $address = isset($data['address']) && $data['address'] != '' ? $data['address'] : '';
        $email = isset($data['email']) && $data['email'] != '' ? $data['email'] : '';
        $login = isset($data['login']) && $data['login'] != '' ? $data['login'] : '';
        $password = isset($data['password']) && $data['password'] != '' ? $data['password'] : '';
        $gender = isset($data['gender']) && $data['gender'] != '' ? $data['gender'] : '';
        $admissionDate = isset($data['admissionDate']) && $data['admissionDate'] != '' ? $data['admissionDate'] : '';
        $diploma = isset($data['diploma']) && $data['diploma'] != '' ? $data['diploma'] : '';
        $grade = isset($data['grade']) && $data['grade'] != '' ? $data['grade'] : '';
        $lastUpgradeDate = isset($data['lastUpgradeDate']) && $data['lastUpgradeDate'] != '' ? $data['lastUpgradeDate'] : '';
        return new self(null, $name, $surname, $birthDate, $address, $email, $login, $password, $gender, $admissionDate, $diploma, $grade, $lastUpgradeDate);
    }

    /**
     * Permet de modifier les attributs d'un Militaire depuis les valeurs d'un tableau.
     * @param $data
     */
    public function updateFromArray($data)
    {
        if (isset($data['name'])) {
            $this->setName($data['name']);
        }
        if (isset($data['surname'])) {
            $this->setSurname($data['surname']);
        }
        if (isset($data['birthDate'])) {
            $this->setBirthDate($data['birthDate']);
        }
        if (isset($data['address'])) {
            $this->setAddress($data['address']);
        }
        if (isset($data['email'])) {
            $this->setEmail($data['email']);
        }
        if (isset($data['login'])) {
            $this->setLogin($data['login']);
        }
        if (isset($data['password'])) {
            $this->setPassword($data['password']);
        }
        if (isset($data['gender'])) {
            $this->setGender($data['gender']);
        }
        if (isset($data['admissionDate'])) {
            $this->setAdmissionDate($data['admissionDate']);
        }
        if (isset($data['diploma'])) {
            $this->setDiploma($data['diploma']);
        }
        if (isset($data['grade'])) {
            $this->setGrade($data['grade']);
        }
        if (isset($data['lastUpgradeDate'])) {
            $this->setLastUpgradeDate($data['lastUpgradeDate']);
        }
    }
}