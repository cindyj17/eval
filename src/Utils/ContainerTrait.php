<?php

namespace Oquiz\Utils;

use Psr\Container\ContainerInterface;

/**
 * Trait ContainerTrait
 *
 * Un trait est un élément PHP qui peut être inclus dans n'importe quelle classe
 * Ici, il permet à une classe de se faire injecter un container de services ainsi que récupérer ces derniers
 *
 * @package Oquiz\Utils
 */
trait ContainerTrait
{
    /** @var ContainerInterface */
    protected $container;

    /**
     * Permet d'injecter un container de service
     *
     * @param $container
     * @return $this
     */
    public function setContainer($container)
    {
        $this->container = $container;
        return $this;
    }

    /**
     * Récupère un service, s'il existe, depuis le container de services
     *
     * @param $serviceId
     * @return mixed
     */
    protected function get($serviceId)
    {
        if (!$this->has($serviceId)) {
            throw new \LogicException('Service "' . $serviceId . '" cannot be found');
        }
        return $this->container[$serviceId];
    }

    /**
     * Permet de vérifier si un service existe dans le container de services
     *
     * @param $serviceId
     * @return bool
     */
    protected function has($serviceId)
    {
        return isset($this->container[$serviceId]);
    }
}