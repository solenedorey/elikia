<?php
namespace Sd\Framework\Cleaners;

use Sd\Framework\AppInterfaces\CleanerInterface;

/**
 * Classe Trim supprimant les espaces en début et fin de chaîne.
 * @package Sd\Framework\Cleaners
 */
class Trim implements CleanerInterface
{
    /**
     * Permet de retourner une chaîne trimée.
     * @param $value
     * @return string
     */
    public function clean($value)
    {
        return trim($value);
    }
}
