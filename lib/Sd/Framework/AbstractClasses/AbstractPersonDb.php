<?php
namespace Sd\Framework\AbstractClasses;

use Jml\Tools\Database\ConnectionSingleton;
use Sd\Framework\AppInterfaces\PersistInterface;

/**
 * Class AbstractPersonDb
 * @package Sd\Framework\AbstractClasses
 */
abstract class AbstractPersonDb implements PersistInterface
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
     * @param AbstractPerson $person
     * @return mixed
     */
    public function persist(AbstractPerson $person)
    {
        if (is_null($person->getId())) {
            return $this->register($person);
        } else {
            return $this->update($person);
        }
    }

    /**
     * @param AbstractPerson $person
     * @return mixed
     */
    abstract public function register(AbstractPerson $person);

    /**
     * @param AbstractPerson $person
     * @return mixed
     */
    abstract public function update(AbstractPerson $person);

    /**
     * @param $id
     * @return mixed
     */
    abstract public function delete($id);
}