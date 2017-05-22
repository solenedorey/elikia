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
    private $yearsOfService;

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
     * Grade constructor.
     * @param int $id
     * @param string $label
     * @param int $yearsOfService
     * @param string $lowerGrade
     * @param int $yearsOfLowerGrade
     */
    public function __construct($id, $label, $yearsOfService, $lowerGrade, $yearsOfLowerGrade)
    {
        $this->id = $id;
        $this->label = $label;
        $this->yearsOfService = $yearsOfService;
        $this->lowerGrade = $lowerGrade;
        $this->yearsOfLowerGrade = $yearsOfLowerGrade;
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
    public function getYearsOfService(): int
    {
        return $this->yearsOfService;
    }

    /**
     * @param int $yearsOfService
     */
    public function setYearsOfService(int $yearsOfService)
    {
        $this->yearsOfService = $yearsOfService;
    }

    /**
     * @return string
     */
    public function getLowerGrade(): string
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
    public function getYearsOfLowerGrade(): int
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
}