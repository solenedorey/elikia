<?php
namespace Sd\Framework\Validators;

use Sd\Framework\AppInterfaces\ValidatorInterface;

/**
 * Classe ChaineNonVide permettant de vérifier si une chaîne n'est pas vide.
 * @package Sd\Framework\Validators
 */
class NonEmptyString implements ValidatorInterface
{
    /**
     * Retourne faux si la chaîne est vide et vrai au contraire.
     * @param $value
     * @return bool
     */
    public function validate($value)
    {
        return $value === "" ? false : true;
    }

    /**
     * Retourne le message à afficher en cas d'erreur.
     * @return string
     */
    public function getMessage()
    {
        return "Le champ ne doit pas être vide.";
    }
}
