<?php
namespace Sd\Framework\Managers;

use Sd\Framework\Exceptions\AuthenticationException;
use Sd\Framework\HttpFoundation\Request;
use Sd\Framework\UserDb;

/**
 * Classe AuthentificationManager qui gère l'authentification des utlisateurs
 * @package Sd\Framework\Managers
 */
class AuthenticationManager
{
    /**
     * $instance est privée pour implémenter le pattern Singleton
     * et être sûr qu'il n'y a qu'une et une seule instance
     */
    private static $instance;

    /**
     * @var
     */
    private $request;

    /**
     * Constructeur de la classe AuthentificationManager.
     * @param Request $request
     */
    private function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Méthode pour accéder à l'UNIQUE instance de la classe.
     *
     * @param Request $request
     * @return AuthentificationManager , l'instance du singleton
     */
    public static function getInstance(Request $request)
    {
        if (!(self::$instance instanceof self)) {
            self::$instance = new self($request);
        }
        return self::$instance;
    }

    /**
     * Permet de savoir si un utlisateur est connecté ou non.
     * @return bool
     */
    public function isConnected()
    {
        return array_key_exists('user', $this->request->getSession()) ? true : false;
    }

    /**
     * Permet de récupérer les infos concernant l'utilisateur.
     * @return null
     */
    public function getInfoUser()
    {
        return $this->isConnected() ? $this->request->getItemSession('user') : null;
    }

    /**
     * @param $id
     * @param $login
     * @param $status
     */
    public function authentication($id, $login, $status)
    {
        $this->request->addItemSession('user', 'id', $id);
        $this->request->addItemSession('user', 'login', $login);
        $this->request->addItemSession('user', 'status', $status);
    }

    /**
     * Permet la déconnexion de l'utilisateur
     */
    public function logOut() {
        $this->request->unsetSession('user');
    }

    /**
     * Vérifie si un utilisateur existe bien et lance sa connexion.
     * @param $login
     * @param $password
     * @throws AuthenticationException
     */
    public function logIn($login, $password)
    {
        $user = (new UserDb())->read($login, $password);
        if ($user) {
            $this->authentication($user->getId(), $user->getLogin(), $user->getStatus());
        } else {
            throw new AuthenticationException();
        }
    }
}
