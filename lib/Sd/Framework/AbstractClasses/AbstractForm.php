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
     * @var AbstractDocument
     */
    protected $person;

    /**
     * @var
     */
    protected $errors;

    /**
     * Constructeur de la classe AbstractDocumentForm.
     * @param AbstractPerson $person
     */
    public function __construct(AbstractPerson $person)
    {
        $this->person = $person;
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
        $this->errors = $manager->validate($this->person);
        return count($this->errors) > 0 ? false : true;
    }

    /**
     * @return mixed
     */
    abstract public function validationStrategy();
}
