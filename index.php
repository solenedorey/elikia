<?php
require 'config/config.php';
require 'vendor/autoload.php';
require 'lib/Sd/Framework/Loader/autoload.php';

spl_autoload_register('autoload');

use Sd\Framework\Controller\FrontController;
use Sd\Framework\HttpFoundation\Response;
use Sd\Framework\HttpFoundation\Request;
use Sd\Framework\Twig\Twig;
use Sd\Elikia\Router\Router;

try {

    session_name(NOM_SESSION);
    session_start();

    /**
     * Initialiser Request et Response
     */
    $request = new Request($_SESSION, $_GET, $_POST, $_FILES);
    $response = new Response();

    $router = new Router($request);

    /**
     * Initialiser le FrontController et l'exécuter
     */
    $controller = new FrontController($router, $request, $response);
    $controller->execute();

} catch (Exception $e) {
    $response->setFile('errorPage.twig');
    if (MODE_DEV) {
        $error = $e->getMessage();
        $error .= '<br>' . nl2br($e->getTraceAsString());
        $response->setFragments(array('error' => $error));
    } else {
        $error = "<p>Une erreur d'exécution s'est produite.</p>";
        $response->setFragments(array('error' => $error));
    }
    header("HTTP/1.0 404 Not Found");
}

$request->synchronizeSession();

/**
 * Récupérer les contenus de la page et les mettre dans les variables du template de page
 */
echo (new Twig($request))->getTwig()->render($response->getFile(), $response->getFragments());
