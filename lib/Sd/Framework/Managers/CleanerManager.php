<?php
namespace Sd\Framework\Managers;

use Sd\Framework\AppInterfaces\CleanerInterface;

/**
 * Classe CleanerManager gérant les nettoyeurs.
 * @package Sd\Framework\Managers
 */
class CleanerManager
{
    /**
     * @var array
     */
    private $cleaners = array();
    
    /**
     * Permet de définir les nettoyeurs à utiliser sur une valeur donnée.
     * @param $property
     * @param CleanerInterface $cleaner
     * @return $this
     */
    public function add($property, CleanerInterface $cleaner)
    {
        $this->cleaners[] = [$property, $cleaner];
        return $this;
    }

    /**
     * Permet d'exécuter le nettoyage selon la liste des nettoyeurs.
     * @param $form
     * @return mixed
     */
    public function clean($form)
    {
        foreach ($this->cleaners as $cleanerItem) {
            $property = $cleanerItem[0];
            $cleaner = $cleanerItem[1];
            if (isset($form[$property])) {
                $form[$property] = $cleaner->clean($form[$property]);
            }
        }
        return $form;
    }
}
