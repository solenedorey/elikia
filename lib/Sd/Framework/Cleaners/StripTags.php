<?php
namespace Sd\Framework\Cleaners;

use Sd\Framework\AppInterfaces\CleanerInterface;

/**
 * Classe StripTags supprimant les balises HTML et PHP d'une chaîne.
 * @package Sd\Framework\Cleaners
 */
class StripTags implements CleanerInterface
{
    /**
     * @var null
     */
    private $exclusion;

    /**
     * Constructeur de la classe StripTags.
     * @param $exclusion
     */
    public function __construct($exclusion = null)
    {
        $this->exclusion = $exclusion;
    }

    /**
     * Permet de retourner une chaîne sans balises HTML et PHP.
     * @param $value
     * @return string
     */
    public function clean($value)
    {
        return strip_tags($value, $this->exclusion);
    }
}
