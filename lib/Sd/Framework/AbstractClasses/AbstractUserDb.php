<?php
namespace Sd\Framework\AbstractClasses;

use Jml\Tools\Database\ConnectionSingleton;
use Sd\Framework\AppInterfaces\PersistInterface;

/**
 * Class AbstractUserDb
 * @package Sd\Framework\AbstractClasses
 */
abstract class AbstractUserDb implements PersistInterface
{
    /**
     * @var
     */
    protected $db;

    /**
     * Constructeur de la classe AbstractDocumentBd.
     */
    public function __construct()
    {
        $this->db = ConnectionSingleton::getInstance()->getConnection();
    }
    
    /**
     * Permet d'exécuter une requête en base de données.
     * @param $request
     * @param $return
     * @param null $param
     * @return array|bool
     */
    protected function SqlRequest($request, $return, $param = null)
    {
        $stmt = $this->db->prepare($request);
        $stmt->execute($param);
        return $return ? $stmt->fetchAll(\PDO::FETCH_ASSOC) : true;
    }

    /**
     * @param $id
     * @return mixed
     */
    abstract public function read($id);

    /**
     * @return mixed
     */
    abstract public function readAll();

    /**
     * @param AbstractUser $user
     * @return mixed
     */
    public function persist(AbstractUser $user)
    {
        if (is_null($user->getId())) {
            return $this->register($user);
        } else {
            return $this->update($user);
        }
    }

    /**
     * @param AbstractUser $user
     * @return mixed
     */
    abstract public function register(AbstractUser $user);

    /**
     * @param AbstractUser $user
     * @return mixed
     */
    abstract public function update(AbstractUser $user);

    /**
     * @param $id
     * @return mixed
     */
    abstract public function delete($id);
}