<?php
namespace Sd\Framework\Validators;

use Sd\Framework\AppInterfaces\ValidatorInterface;

/**
 * Classe LongueurMaxi vérifiant qu'une valeur ne dépasse pas une taille donnée.
 * @package Sd\Framework\Validators
 */
class MaxLength implements ValidatorInterface
{
    /**
     * @var
     */
    private $limit;

    /**
     * Constructeur de la classe LongueurMaxi.
     * @param $limit
     */
    public function __construct($limit)
    {
        $this->limit = $limit;
    }

    /**
     * Retourne faux si la chaîne dépasse la taille définie et vrai au contraire.
     * @param $value
     * @return bool
     */
    public function validate($value)
    {
        return strlen($value) > $this->limit ? false : true;
    }

    /**
     * Retourne le message à afficher en cas d'erreur.
     * @return string
     */
    public function getMessage()
    {
        return "Il faut saisir un contenu de moins de " . $this->limit . " caractères";
    }
}
