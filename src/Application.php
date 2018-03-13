<?php

namespace Oquiz;

use League\Plates\Engine;
use Oquiz\Controllers\CoreController;
use Oquiz\Controllers\MainController;
use Pimple\Container;

/**
 * Class Application
 *
 * Classe qui permet de charger l'application e.q. the bootstrap
 *
 * @package Oquiz
 */
class Application
{
    /**
     * Objet pour charger les services
     * Peut être utiliser comme un array (\ArrayAccess)
     * @var Container
     */
    protected $container;

    /**
     * Application constructor.
     * @todo Déplacer le chargement de la database dans un service a part (injecter dans le service container)
     */
    public function __construct()
    {
        // J'ai créé un dossier config.ini pour y mettre les paramètres de la BDD
        // Je récupère ces infos
        $config = parse_ini_file(__DIR__ . '/../config.ini');
        // Je transmet les informations de connexion
        // de ma BDD à ma classe Database
        \Oquiz\Utils\Database::setConfig($config);
    }

    /**
     * Methode à appeler avant la methode run()
     * Charge le conteneur de service
     */
    public function start()
    {
        $this->container = new Container();
        $this->initRouter();
        $this->initTemplateEngine();
    }

    /**
     * Methode pour démarrer l'application
     *
     * Charge le controller avec le container et execute la methode mappé par le router
     *
     * # Récupère les parametres du router,
     *  - Si le router a trouvé une route
     *  - Et si le controller est un CoreController
     *  - Et si la methode existe dans le controller
     *   - alors on charge le controller
     *  - Sinon on redirige vers page not found controller
     *
     * En cas d'erreur dans l'execution du controller, redirection vers page d'erreur
     *
     */
    public function run()
    {
        try {
            $router = $this->container['router'];
            $match = $router->match();
            if ($match === false) {
                throw new \BadMethodCallException('Route not found');
            }

            $controllerName = '\Oquiz\Controllers\\' . $match['target'][0];
            $methodName = $match['target'][1];
            $params = $match['params'];

            if (!is_a($controllerName, CoreController::class, true)) {
                throw new \BadMethodCallException('Controller cannot be constructed');
            }
            if (!is_callable([new $controllerName(), $methodName])) {
                throw new \BadMethodCallException('Controller cannot handle the request');
            }

        } catch (\BadMethodCallException $e) {
            $controller = new MainController();
            $controller->setContainer($this->container);
            call_user_func([$controller, 'error404']);
            exit();
        }

        try {
            /** @var CoreController $controller */
            $controller = new $controllerName();
            $controller->setContainer($this->container);
            $callable = [$controller, $methodName];
            call_user_func($callable, $params);
        } catch (\Exception $e) {
            $controller = new MainController();
            $controller->setContainer($this->container);
            call_user_func([$controller, 'error500']);
        }

    }

    /**
     * Initialise le router avec les routes de l'application et le basePath
     * @todo Charger les routes depuis un fichier de config
     */
    protected function initRouter()
    {
        $router = new \AltoRouter(
            array(
                // La page d'accueil
                ['GET', '/', ['MainController', 'indexAction'], 'home'],
                // La page d'un quiz
                ['GET', '/quiz/[i:id]', ['QuizController', 'read'], 'quiz'],
                // La page d'un quiz en tant que user
                ['GET', '/list-form/[i:id]', ['QuizController', 'read'], 'list-form'],
                //Page d'inscription
                ['GET|POST', '/signup', ['UserController', 'create'], 'signup'],
                // Page de connexion
                ['GET|POST', '/signin', ['UserController', 'signin'], 'signin'],
                // Page de profil
                ['GET', '/compte', ['UserController', 'read'], 'compte'],
                // Page de déconnexion
                ['GET|POST', '/signout', ['UserController', 'signout'], 'signout'],

            ),
            isset($_SERVER['BASE_URI']) ? $_SERVER['BASE_URI'] : ''
        );
        $this->container['router'] = $router;
    }

    /**
     * Initialise le template engine
     */
    protected function initTemplateEngine()
    {
        $this->container['templateEngine'] = new Engine(__DIR__ . '/Views/');
    }
}
