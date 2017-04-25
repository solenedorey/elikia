<?php
namespace Sd\Framework\AppInterfaces;

/**
 * Interface FormInterface définissant les méthodes obligatoires pour tout objet de type Form.
 * @package Sd\Framework\AppInterfaces
 */
interface FormInterface
{
    /**
     * Permet de nettoyer les données d'un formulaire.
     * @param $form
     * @return mixed
     */
    public static function clean($form);

    /**
     * Permet de déterminer si un formulaire est valide.
     * @return mixed
     */
    public function isValid();

    /**
     * Permet d'accéder aux messages d'erreur.
     * @param $field
     * @return mixed
     */
    public function getError($field);
}
