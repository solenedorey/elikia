<?php
namespace Sd\Framework\AppInterfaces;

/**
 * Interface CleanerInterface définissant les méthodes obligatoires pour tout objet de type Cleaner.
 * @package Sd\Framework\AppInterfaces
 */
interface CleanerInterface
{
    /**
     * Permet de renvoyer une valeur nettoyée.
     * @param $value
     * @return mixed
     */
    public function clean($value);
}
