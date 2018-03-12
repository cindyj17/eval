<?php

namespace Oquiz\Models;

class CoreModel {

  protected static $tableName;

  public static function findAll() {

      // On récupère la connexion à la BDD
      $conn = \Oquiz\Utils\Database::getDB();

      // On crée la requête SQL de récupération des données
      $sql = 'SELECT * FROM ' . static::$tableName . ' ORDER BY ' . static::$orderBy;

      // On exécute la requête
      $stmt = $conn->query($sql);

      // On récupère tous les résultats
      return $stmt->fetchAll(\PDO::FETCH_CLASS, static::class);
  }

}
