<?php
namespace Sd\Elikia\Page;

use Sd\Framework\AbstractClasses\AbstractController;
use Sd\Framework\HttpFoundation\Response;
use Sd\Framework\HttpFoundation\Request;
use Sd\Framework\Managers\AuthenticationManager;

/**
 * Classe PageControleur
 * @package Sd\Elikia\Page
 */
class PageController extends AbstractController
{
    /**
     * @var Request
     * @var Request
     */

    /**
     * Constructeur de la classe PageController.
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        parent::__construct($response, $request);
    }

    /**
     * Affiche la page A propos.
     */
    public function about()
    {
        $this->render('about.twig');
    }

    /**
     * Affiche la page d'accueil.
     */
    public function home()
    {
        $this->render('index.twig');
    }

    /**
     * Permet la déconnexion de l'utilisateur connecté et redirige vers l'accueil.
     */
    public function logOut()
    {
        AuthenticationManager::getInstance($this->request)->logOut();
        header('Location: index.php');
    }
}
