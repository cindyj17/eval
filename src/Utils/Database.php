<?php

namespace Oquiz\Utils;

class Database {

    // La propriété qui contiendra la connexion
    // à la BDD
    private static $db;
    private static $config;

    public  static function setConfig($conf) {

        // On enregistre les informations contenues
        // dans "$conf" à l'intèrieur de la propriété
        // "$config" (qui est une propiété en static,
        // du coup, on utilise "self::$config")
        self::$config = $conf;
    }

    // Retourne la connexion à la BDD
    public static function getDB() {

        // On regarde si on a déjà créer une connexion à la BDD
        // si ce n'est pas le cas on la crée
        if (!isset(self::$db)) {

            // On va regarder si il y a des erreurs
            try {

                // On crée la connexion grâce aux informations
                // récupérées à partir du fichier de config
                self::$db = new \PDO(
                    "mysql:host=".self::$config['host'].";dbname=".self::$config['dbname'].";charset=".self::$config['charset'],
                    self::$config['dbuser'], // Nom d'utilisateur
                    self::$config['dbpassword'] // MDP utilisateur

                );
            }
            catch (\PDOException $e) {

                die('ERREUR DE CONNEXION !!!');
            }
            catch (\Exception $e) {

                die('AUTRE TYPE D\'ERREUR !!!');
            }
        }
        return self::$db;
    }

}
