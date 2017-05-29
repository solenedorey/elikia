<?php
namespace Sd\Elikia\Page;

use Sd\Elikia\Admin\AdminDb;
use Sd\Elikia\Secretary\SecretaryDb;
use Sd\Elikia\Soldier\SoldierDb;
use Sd\Framework\AbstractClasses\AbstractController;
use Sd\Framework\Exceptions\AuthenticationException;
use Sd\Framework\HttpFoundation\Response;
use Sd\Framework\HttpFoundation\Request;
use Sd\Framework\Managers\AuthenticationManager;

/**
 * Class PageController
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

    /**
     * Permet l'affichage des informations de l'utilisateur connecté
     */
    public function displayMyInformation()
    {
        if (!AuthenticationManager::getInstance()->isConnected()) {
            throw new AuthenticationException();
        }
        $user = AuthenticationManager::getInstance($this->request);
        $status = $user->getInfoUser('status');
        $id = $user->getInfoUser('id');
        switch ($status) {
            case 'soldier':
                $soldier = (new SoldierDb)->read($id);
                $this->render('soldier/soldierDetails.twig', array('soldier' => $soldier));
                break;
            case 'secretary':
                $secretary = (new SecretaryDb)->read($id);
                $this->render('secretary/secretaryDetails.twig', array('secretary' => $secretary));
                break;
            case 'admin':
                $admin = (new AdminDb)->read($id);
                $this->render('admin/adminDetails.twig', array('admin' => $admin));
                break;
        }

    }
}
