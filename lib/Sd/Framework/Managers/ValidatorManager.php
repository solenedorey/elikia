<?php
namespace Sd\Framework\Managers;

use Sd\Framework\AppInterfaces\ValidatorInterface;

/**
 * Classe ValidateurManager gérant les validateurs.
 * @package Sd\Framework\Managers
 */
class ValidatorManager
{
    /**
     * @var array
     */
    private $validators = array();
    
    /**
     * Permet de définir les validateurs à utiliser sur une valeur donnée.
     * @param $property
     * @param ValidatorInterface $validator
     * @return $this
     */
    public function add($property, ValidatorInterface $validator)
    {
        $this->validators[] = [$property, $validator];
        return $this;
    }

    /**
     * Permet d'exécuter la validation selon la liste des validateurs.
     * @param $object
     * @return array
     * @throws \Exception
     */
    public function validate($object)
    {
        $errors =array();
        foreach ($this->validators as $validatorItem) {
            $property = $validatorItem[0];
            $validator = $validatorItem[1];
            // le getter est de la forme getTitre
            // il faut donc prendre la propriété avec la 1ère lettre en majuscule
            $getter = 'get' . ucfirst($property);
            if (!method_exists($object, $getter)) {
                // si le getter n'existe pas => lever Exception
                $message = "Méthode {$getter} non existante pour la classe " . get_class($object);
                throw new \Exception($message);
            }
            // récupérer la valeur à vérifier
            $value = $object->$getter();
            if (! $validator->validate($value)) {
                // la validation a échoué => ajouter un message d'erreur.
                $errors[$property][] = $validator->getMessage();
            }
        }
        return $errors;
    }
}

