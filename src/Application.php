<?php

namespace Oquiz;

class Application {

    public function __construct() {

        // J'ai créé un dossier config.ini pour y mettre les paramètres de la BDD
        // Je récupère ces infos
        $config = parse_ini_file(__DIR__ . '/../config.ini');
        // Je transmet les informations de connexion
        // de ma BDD à ma classe Database
        \Oquiz\Utils\Database::setConfig( $config );

        // Je crée le routeur
        $this->router = new \AltoRouter();

        // J'ignore une partie de l'url
        // Je récupère donc la partie de l'URL qui est
        // fixe grâce à $_SERVER['BASE_URI']
        $basePath = isset($_SERVER['BASE_URI']) ? $_SERVER['BASE_URI'] : '';

        // Je renseigne la partie de l'URL fixe
        $this->router->setBasePath($basePath);

        // Je lance le mapping
        $this->mapping();
    }

    public function mapping() {

        // Je mappe toutes les URL
        // La page d'accueil
        $this->router->map('GET', '/', ['MainController', 'indexAction'], 'home');
        // La page d'un quiz
        $this->router->map('GET', '/quiz/[i:id]',['QuizController','read'], 'quiz');
        // La page d'un quiz en tant que user
        $this->router->map('GET', '/list-form/[i:id]',['QuizController','read'], 'list-form');
        //Page d'inscription
        $this->router->map('GET|POST', '/signup', ['UserController', 'create'], 'signup');
        // Page de connexion
        $this->router->map('GET|POST', '/signin', ['UserController', 'signin'], 'signin');
        // Page de profil
        $this->router->map('GET', '/compte', ['UserController', 'read'], 'compte');
        // Page de déconnexion
        $this->router->map('GET|POST', '/signout', ['UserController', 'signout'], 'signout');
    }

    public function run () {


        // Je récupère les données de Altorouter
        $match = $this->router->match();

        if (!$match) {

            // On a pas trouvé la route, on indique le nouveau chemin
            $controllerName = "\Oquiz\Controllers\MainController";
            $methodName = 'error404';
        }
        else {

            // Je regarde quel controller et quelle méthode je dois éxecuter
            $controllerName = "\Oquiz\Controllers\\" . $match['target'][0];
            $methodName = $match['target'][1];
        }

        // J'éxecute la bonne méthodes
        $controller = new $controllerName( $this->router );
        // J' profite pour transmettre les paramètres
        // contenus dans l'URL (si il y en a )
        $controller->$methodName($match['params']);

    }
}
