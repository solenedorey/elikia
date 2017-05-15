<?php
namespace Sd\Framework\Controller;

use Sd\Elikia\Router\Router;
use Sd\Framework\Exceptions\AuthenticationException;
use Sd\Framework\Managers\AuthenticationManager;
use Sd\Framework\HttpFoundation\Response;
use Sd\Framework\HttpFoundation\Request;

/**
 * Classe FrontController
 * @package Sd\Framework\Controller
 */
class FrontController
{
    /**
     * @var Router
     */
    protected $router;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Response
     */
    protected $response;

    /**
     * Constructeur de la classe FrontController.
     * @param Router $router
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Router $router, Request $request, Response $response)
    {
        $this->router = $router;
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * Permet de lancer le contrôleur et exécuter l'action à faire.
     * @return mixed
     */
    public function execute()
    {
        $authManager = AuthenticationManager::getInstance($this->request);
        $formData = $this->request->getPost();
        if (isset($formData['auth_login']) && isset($formData['auth_password'])) {
            try {
                $authManager->logIn($formData['auth_login'], $formData['auth_password']);
            } catch (AuthenticationException $e) {
            }
        }
        $className = $this->router->getControllerClassName();
        $controller = new $className($this->request, $this->response);
        $action = $this->router->getControllerAction();
        $controller->execute($action);
    }
}
