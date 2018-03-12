<?php

namespace Oquiz\Models;

class QuizModel{

  protected static $tablename = 'quizzes';
  protected static $orderBy = 'id';

  protected $id;
  protected $title;
  protected $description;
  protected $id_author;

    public static function findAll() {

        // On récupère la connexion à la BDD
        $conn = \Oquiz\Utils\Database::getDB();

        // On crée la requête SQL de récupération des données
        $sql = 'SELECT * FROM quizzes';

        // On exécute la requête
        $stmt = $conn->query($sql);

        // On récupère tous les résultats
        return $stmt->fetchAll(\PDO::FETCH_CLASS, '\Oquiz\Models\QuizModel');
    }

    public static function findById($id) {

        // On récupère la connexion à la BDD
        $conn = \Oquiz\Utils\Database::getDB();

        $sql = 'SELECT * FROM quizzes WHERE id=' . $id;

        // On éxécute la requête
        $stmt = $conn->query($sql);

        // On précise le type de fetch à utiliser
        $stmt->setFetchMode(\PDO::FETCH_CLASS, '\Oquiz\Models\QuizModel');

        // On récupère le premier évènement
        // retourné par la requête
        return $stmt->fetch(\PDO::FETCH_CLASS);
    }

    /**
     * Get the value of Id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of Title
     *
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of Title
     *
     * @param mixed title
     *
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of Description
     *
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of Description
     *
     * @param mixed description
     *
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of Id Author
     *
     * @return mixed
     */
    public function getIdAuthor()
    {
        return $this->id_author;
    }

    /**
     * Set the value of Id Author
     *
     * @param mixed id_author
     *
     * @return self
     */
    public function setIdAuthor($id_author)
    {
        $this->id_author = $id_author;

        return $this;
    }

}
