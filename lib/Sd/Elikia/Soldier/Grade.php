<?php
namespace Sd\Elikia\Soldier;

/**
 * Class Grade
 * @package Sd\Elikia\Soldier
 */
class Grade
{
    /**
     * Identifiant du grade
     * @var int
     */
    private $id;

    /**
     * Intitulé du grade
     * @var string
     */
    private $label;

    /**
     * Nombre d'années de services effectifs nécessaire à l'obtention du grade
     * @var int
     */
    private $yearsOfServiceToUpgrade;

    /**
     * Grade précédent nécessaire à l'obtention du grade
     * @var string
     */
    private $lowerGrade;

    /**
     * Nombre d'années effectuées sous le grade précédent nécessaire à l'obtention du grade
     * @var int
     */
    private $yearsOfLowerGrade;

    /**
     * Diplôme requis pour l'obtention du grade
     * @var int
     */
    private $diplomaType;

    /**
     * Age requis pour partir à la retraite avec ce grade
     * @var int
     */
    private $ageToRetire;

    /**
     * Nombre d'années de services effectis requis pour partir à la retraite avec ce grade
     * @var int
     */
    private $yearsToRetire;

    /**
     * Grade constructor.
     * @param int $id
     * @param string $label
     * @param int $yearsOfServiceToUpgrade
     * @param string $lowerGrade
     * @param int $yearsOfLowerGrade
     * @param int $diplomaType
     * @param int $ageToRetire
     * @param int $yearsToRetire
     */
    public function __construct(
        $id,
        $label,
        $yearsOfServiceToUpgrade,
        $lowerGrade,
        $yearsOfLowerGrade,
        $diplomaType,
        $ageToRetire,
        $yearsToRetire
    ) {
        $this->id = $id;
        $this->label = $label;
        $this->yearsOfServiceToUpgrade = $yearsOfServiceToUpgrade;
        $this->lowerGrade = $lowerGrade;
        $this->yearsOfLowerGrade = $yearsOfLowerGrade;
        $this->diplomaType = $diplomaType;
        $this->ageToRetire = $ageToRetire;
        $this->yearsToRetire = $yearsToRetire;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param mixed $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * @return int
     */
    public function getYearsOfServiceToUpgrade()
    {
        return $this->yearsOfServiceToUpgrade;
    }

    /**
     * @param int $yearsOfServiceToUpgrade
     */
    public function setYearsOfServiceToUpgrade(int $yearsOfServiceToUpgrade)
    {
        $this->yearsOfServiceToUpgrade = $yearsOfServiceToUpgrade;
    }

    /**
     * @return string
     */
    public function getLowerGrade()
    {
        return $this->lowerGrade;
    }

    /**
     * @param string $lowerGrade
     */
    public function setLowerGrade(string $lowerGrade)
    {
        $this->lowerGrade = $lowerGrade;
    }

    /**
     * @return int
     */
    public function getYearsOfLowerGrade()
    {
        return $this->yearsOfLowerGrade;
    }

    /**
     * @param int $yearsOfLowerGrade
     */
    public function setYearsOfLowerGrade(int $yearsOfLowerGrade)
    {
        $this->yearsOfLowerGrade = $yearsOfLowerGrade;
    }

    /**
     * @return int
     */
    public function getDiplomaType()
    {
        return $this->diplomaType;
    }

    /**
     * @param int $diplomaType
     */
    public function setDiplomaType($diplomaType)
    {
        $this->diplomaType = $diplomaType;
    }

    /**
     * @return int
     */
    public function getAgeToRetire()
    {
        return $this->ageToRetire;
    }

    /**
     * @param int $ageToRetire
     */
    public function setAgeToRetire($ageToRetire)
    {
        $this->ageToRetire = $ageToRetire;
    }

    /**
     * @return int
     */
    public function getYearsToRetire()
    {
        return $this->yearsToRetire;
    }

    /**
     * @param int $yearsToRetire
     */
    public function setYearsToRetire($yearsToRetire)
    {
        $this->yearsToRetire = $yearsToRetire;
    }
}