<?php
namespace Sd\Framework\Twig;

use Sd\Framework\HttpFoundation\Request;
use Sd\Framework\Managers\AuthenticationManager;
use Twig_Environment;
use Twig_Loader_Filesystem;
use Twig_SimpleFunction;

/**
 * Classe Twig permettant de gérer les templates.
 * @package Sd\Framework\Twig
 */
class Twig
{
    /**
     * @var Twig_Environment
     */
    private $twig;

    private $request;

    /**
     * Constructeur de la classe Twig.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;

        //loader
        $loader = new Twig_Loader_Filesystem(array('assets/templates', 'lib/Sd/Framework/Views'));

        //init
        $this->twig = new Twig_Environment($loader, array(
            'cache' => false,
            'debug' => true
        ));

        //debug
        $this->twig->addExtension(new \Twig_Extension_Debug());

        //functions
        $displayErrors = new Twig_SimpleFunction('display_errors', function ($errors) {
            echo $this->twig->render('frag/formErrors.twig', array(
                'errors' => $errors
            ));
        });
        $this->twig->addFunction($displayErrors);

        $requestUri = new Twig_SimpleFunction('request_uri', function () {
            echo $_SERVER['REQUEST_URI'];
        });
        $this->twig->addFunction($requestUri);

        $isConnected = new Twig_SimpleFunction('is_connected', function () {
            return AuthenticationManager::getInstance($this->request)->isConnected();
        });
        $this->twig->addFunction($isConnected);
        $isXhrRequest = new Twig_SimpleFunction('is_xhr_request', function () {
            return $this->request->isXhrRequest();
        });
        $this->twig->addFunction($isXhrRequest);
    }

    /**
     * @return Twig_Environment
     */
    public function getTwig()
    {
        return $this->twig;
    }
}
