<?php
namespace Sd\Framework\Validators;

use Sd\Framework\AppInterfaces\ValidatorInterface;

/**
 * Classe EmailValide vérifiant la validité d'un e-mail.
 * @package Sd\Framework\Validators
 */
class ValidEmail implements ValidatorInterface
{
    /**
     * Retourne faux si l'e-mail n'est pas valide et vrai au contraire.
     * @param $valeur
     * @return bool
     */
    public function validate($valeur)
    {
        return filter_var($valeur, FILTER_VALIDATE_EMAIL) ? true : false;
    }

    /**
     * Retourne le message à afficher en cas d'erreur.
     * @return string
     */
    public function getMessage()
    {
        return "Le champ auteur n'est pas valide. Une adresse mail est requise.";
    }
}
