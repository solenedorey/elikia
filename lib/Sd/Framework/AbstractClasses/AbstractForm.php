<?php
namespace Sd\Framework\AbstractClasses;

use Sd\Framework\AppInterfaces\FormInterface;

/**
 * Classe AbstractForm
 * @package Sd\Framework\AbstractClasses
 */
abstract class AbstractForm implements FormInterface
{
    /**
     * @var AbstractUser
     */
    protected $user;

    /**
     * @var
     */
    protected $errors;

    /**
     * Constructeur de la classe AbstractDocumentForm.
     * @param AbstractUser $user
     */
    public function __construct(AbstractUser $user)
    {
        $this->user = $user;
    }

    /**
     * Permet de récupérer une erreur.
     * @param $field
     * @return string
     */
    public function getError($field)
    {
        if (isset($this->errors[$field])) {
            return '<span class="error">' . $this->errors[$field] . '</span>';
        } else {
            return '';
        }
    }

    /**
     * @return mixed
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Permet de récupérer les actions de nettoyage à réaliser sur les différentes valeurs et d'exécuter ces actions.
     * @param $form
     * @return mixed
     */
    public static function clean($form)
    {
        $manager = static::cleaningStrategy();
        $form = $manager->clean($form);
        return $form;
    }

    /**
     * Permet de récupérer les actions de validation à réaliser sur les différentes valeurs et d'exécuter ces actions.
     * @return bool
     */
    public function isValid()
    {
        $manager = $this->validationStrategy();
        $this->errors = $manager->validate($this->user);
        return count($this->errors) > 0 ? false : true;
    }

    /**
     * @return mixed
     */
    abstract public function validationStrategy();
}
