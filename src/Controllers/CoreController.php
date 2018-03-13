<?php

namespace Oquiz\Controllers;

use League\Plates\Engine;
use Oquiz\Utils\ContainerTrait;

/**
 * Classe abstraite qui sera héritée par tous les $controllers
 * Ces controllers hériteront des propriétés et méthodes inhérentes à la fonction de controller
 *
 * @package Oquiz\Controllers
 */
abstract class CoreController
{
    // Trait pour gérer le container (injection du container et manipulation des services)
    use ContainerTrait;

    protected $user;

    /** @var Engine Le moteur pour générer des templates */
    private $renderer;

    /**
     * Permet de construire un template depuis un $routeName et des $params optionels
     *
     * @param $routeName
     * @param array $params
     */
    protected function render($routeName, $params = [])
    {
        echo $this->getRenderer()->render(
            $routeName,
            $params
        );
        exit();
    }

    /**
     * Fait une redirection HTTP
     * @todo Créer un router à l'intérieur de l'appli qui étendera AltoRouter avec une méthode redirect en plus
     *
     * @param $routeName
     * @param array $params
     * @throws \Exception
     */
    protected function redirect($routeName, $params = [])
    {
        header('Location: ' . $this->getRouter()->generate($routeName, $params));
        exit();
    }

    /**
     * Permet de retrouver le service qui gére les templates
     * @todo Créer un router à l'intérieur de l'appli qui étendera AltoRouter avec une méthode getBasePath en plus
     *
     * @return Engine
     */
    protected function getRenderer()
    {
        if (!$this->renderer) {
            $basePath = isset($_SERVER['BASE_URI']) ? $_SERVER['BASE_URI'] : '';
            $this->renderer = $this->get('templateEngine')->addData([
                'baseUrl' => $basePath,
                'router' => $this->getRouter(),
                'user' => $this->user
            ]);
        }
        return $this->renderer;
    }

    /**
     * Permet de retrouver le service qui gére les routes
     *
     * @return \AltoRouter
     */
    protected function getRouter()
    {
        return $this->get('router');
    }
}
