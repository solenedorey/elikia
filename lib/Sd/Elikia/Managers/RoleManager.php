<?php
namespace Sd\Elikia\Managers;

use Sd\Framework\Exceptions\AccessDeniedException;
use Sd\Framework\Managers\AuthenticationManager;

/**
 * Class RoleManager permettant de gérer les droits d'accès.
 * @package Sd\MiniJournal\Managers
 */
class RoleManager
{

    /**
     * $instance est privée pour implémenter le pattern Singleton
     * et être sûr qu'il n'y a qu'une et une seule instance
     */
    private static $instance;

    /**
     * Méthode pour accéder à l'UNIQUE instance de la classe.
     * @return RoleManager, l'instance du singleton
     */
    public static function getInstance()
    {
        if (!(self::$instance instanceof self)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Permet de vérifier les droits d'accès.
     * @param $status
     * @return bool
     * @throws AccessDeniedException
     */
    public function verifyAccess($status)
    {
        $authManager = AuthenticationManager::getInstance();
        $userStatus = $authManager->getInfoUser('status');
        if ($userStatus == 'admin') {
            return true;
        }
        if ($userStatus !== $status) {
            throw new AccessDeniedException();
        }
        return true;
    }
}