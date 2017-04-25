<?php
namespace Sd\Elikia\Soldier;

use Sd\Framework\AbstractClasses\AbstractForm;
use Sd\Framework\Managers\CleanerManager;
use Sd\Framework\Managers\ValidatorManager;

//Cleaners
use Sd\Framework\Cleaners\StripTags;
use Sd\Framework\Cleaners\Trim;

//Validators
use Sd\Framework\Validators\MaxLength;
use Sd\Framework\Validators\NonEmptyString;
use Sd\Framework\Validators\ValidEmail;

class SoldierForm extends AbstractForm
{
    /**
     * Permet de nettoyer les données postées via un formulaire.
     * @return CleanerManager
     */
    public static function cleaningStrategy()
    {
        $cleanerManager = new CleanerManager();
        $cleanerManager->add('name', new Trim())
            ->add('name', new StripTags())
            ->add('surname', new Trim())
            ->add('surname', new StripTags());
        return $cleanerManager;
    }

    /**
     * Permet de valider les données postées via un formulaire.
     * @return ValidatorManager
     */
    public function validationStrategy()
    {
        $validatorManager = new ValidatorManager();
        $validatorManager->add('name', new NonEmptyString())
            ->add('name', new MaxLength(255))
            ->add('surname', new NonEmptyString())
            ->add('email', new ValidEmail());
        return $validatorManager;
    }
}
