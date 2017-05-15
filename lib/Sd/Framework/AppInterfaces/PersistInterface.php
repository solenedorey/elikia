<?php
namespace Sd\Framework\AppInterfaces;

use Sd\Framework\AbstractClasses\AbstractUser;

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
     * @param AbstractUser $user
     * @return mixed
     */
    public function persist(AbstractUser $user);

    /**
     * @param AbstractUser $user
     * @return mixed
     */
    public function register(AbstractUser $user);

    /**
     * @param AbstractUser $user
     * @return mixed
     */
    public function update(AbstractUser $user);

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);
}
