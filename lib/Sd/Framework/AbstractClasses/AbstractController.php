<?php
namespace Sd\Framework\AbstractClasses;

use Sd\Framework\HttpFoundation\Response;

/**
 * Classe AbstractController
 * @package Sd\Framework\AbstractClasses
 */
abstract class AbstractController
{
    /**
     * @var Response
     */
    private $response;

    /**
     * Constructeur de la classe AbstractController.
     * @param $response
     */
    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    /**
     * Permet d'exécuter le contrôleur de classe pour effectuer l'action $action.
     * @param $action
     * @return mixed
     * @throws \Exception
     */
    public function execute($action)
    {
        if (method_exists($this, $action)) {
            return $this->$action();
        } else {
            throw new \Exception("Action {$action} non trouvée");
        }
    }

    /**
     * Permet de charger les données dans le template correspondant.
     * @param $file
     * @param null $fragments
     */
    public function render($file, $fragments = null)
    {
        $this->response->setFile($file);
        if ($fragments != null) {
            $this->response->setFragments($fragments);
        }
    }
}
