<?php
namespace Sd\Elikia\Router;

use Sd\Framework\HttpFoundation\Request;

/**
 * Classe Router
 * @package Sd\Elikia\Router
 */
class Router
{
    /**
     * @var
     */
    protected $controllerClassName;
    /**
     * @var
     */
    protected $controllerAction;
    /**
     * @var Request
     */
    protected $request;

    /**
     * Constructeur de la classe Router.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->parseRequest();
    }

    /**
     * @return mixed
     */
    public function getControllerClassName()
    {
        return $this->controllerClassName;
    }

    /**
     * @return mixed
     */
    public function getControllerAction()
    {
        return $this->controllerAction;
    }

    /**
     * Implémente la logique entre requête reçue et contrôleur à instancier et action à exécuter.
     * @throws \Exception
     */
    protected function parseRequest()
    {
        // ici le code qui détermine le contrôleur de classe et l'action
        // et les met dans $this->controllerClassName et $this->controllerAction
        $object = isset($_GET['object']) ? $_GET['object'] : null;
        $action = isset($_GET['action']) ? $_GET['action'] : 'home';

        switch ($object) {
            case 'soldier':
                $this->controllerClassName = 'Sd\Elikia\Soldier\SoldierController';
                break;
            case 'secretary':
                $this->controllerClassName = 'Sd\Elikia\Secretary\SecretaryController';
                break;
            default:
                $this->controllerClassName = 'Sd\Elikia\Page\PageController';
                break;
        }

        try {
            class_exists($this->controllerClassName);
        } catch (\Exception $e) {
            throw new \Exception("Classe {$this->controllerClassName} non existante.");
        }

        $this->controllerAction = $action;
    }
}
