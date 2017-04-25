<?php
namespace Sd\Framework\AppInterfaces;

/**
 * Interface ValidatorInterface définissant les méthodes obligatoires pour tout objet de type Validateur.
 * @package Sd\Framework\AppInterfaces
 */
interface ValidatorInterface
{
    /**
     * @param $value
     * @return mixed
     */
    public function validate($value);

    /**
     * @return mixed
     */
    public function getMessage();
}
