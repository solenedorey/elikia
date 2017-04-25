<?php
namespace Sd\Framework\AppInterfaces;

use Sd\Framework\AbstractClasses\AbstractPerson;

/**
 * Interface PersistInterface définissant les méthodes obligatoires pour tout objet de type Bd.
 * @package Sd\Framework\AppInterfaces
 */
interface PersistInterface
{
    /**
     * @param $id
     * @return mixed
     */
    public function read($id);

    /**
     * @return mixed
     */
    public function readAll();

    /**
     * @param AbstractPerson $person
     * @return mixed
     */
    public function persist(AbstractPerson $person);

    /**
     * @param AbstractPerson $person
     * @return mixed
     */
    public function register(AbstractPerson $person);

    /**
     * @param AbstractPerson $person
     * @return mixed
     */
    public function update(AbstractPerson $person);

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);
}
