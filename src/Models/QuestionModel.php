<?php

namespace Oquiz\Models;

class QuestionModel {

    protected static $tablename = 'questions';

    protected $id;
    protected $id_quiz;
    protected $question;
    protected $prop1;
    protected $prop2;
    protected $prop3;
    protected $prop4;
    protected $id_level;
    protected $anecdote;
    protected $wiki;

    public static function findAll() {

        // On récupère la connexion à la BDD
        $conn = \Oquiz\Utils\Database::getDB();

        // On crée la requête SQL de récupération des données
        $sql = 'SELECT * FROM questions';

        // On exécute la requête
        $stmt = $conn->query($sql);

        // On récupère tous les résultats
        return $stmt->fetchAll(\PDO::FETCH_CLASS, '\Oquiz\Models\QuestionModel');
    }

    public function shuffle() {

        $prop[] = $this->prop1;
        $prop[] = $this->prop2;
        $prop[] = $this->prop3;
        $prop[] = $this->prop4;

        shuffle($prop);

        return implode("<li>",$prop);
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
     * Get the value of Id Quiz
     *
     * @return mixed
     */
    public function getIdQuiz()
    {
        return $this->id_quiz;
    }

    /**
     * Set the value of Id Quiz
     *
     * @param mixed id_quiz
     *
     * @return self
     */
    public function setIdQuiz($id_quiz)
    {
        $this->id_quiz = $id_quiz;

        return $this;
    }

    /**
     * Get the value of Question
     *
     * @return mixed
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set the value of Question
     *
     * @param mixed question
     *
     * @return self
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get the value of Prop
     *
     * @return mixed
     */
    public function getProp1()
    {
        return $this->prop1;
    }

    /**
     * Set the value of Prop
     *
     * @param mixed prop1
     *
     * @return self
     */
    public function setProp1($prop1)
    {
        $this->prop1 = $prop1;

        return $this;
    }

    /**
     * Get the value of Prop
     *
     * @return mixed
     */
    public function getProp2()
    {
        return $this->prop2;
    }

    /**
     * Set the value of Prop
     *
     * @param mixed prop2
     *
     * @return self
     */
    public function setProp2($prop2)
    {
        $this->prop2 = $prop2;

        return $this;
    }

    /**
     * Get the value of Prop
     *
     * @return mixed
     */
    public function getProp3()
    {
        return $this->prop3;
    }

    /**
     * Set the value of Prop
     *
     * @param mixed prop3
     *
     * @return self
     */
    public function setProp3($prop3)
    {
        $this->prop3 = $prop3;

        return $this;
    }

    /**
     * Get the value of Prop
     *
     * @return mixed
     */
    public function getProp4()
    {
        return $this->prop4;
    }

    /**
     * Set the value of Prop
     *
     * @param mixed prop4
     *
     * @return self
     */
    public function setProp4($prop4)
    {
        $this->prop4 = $prop4;

        return $this;
    }

    /**
     * Get the value of Id Level
     *
     * @return mixed
     */
    public function getIdLevel()
    {
        return $this->id_level;
    }

    /**
     * Set the value of Id Level
     *
     * @param mixed id_level
     *
     * @return self
     */
    public function setIdLevel($id_level)
    {
        $this->id_level = $id_level;

        return $this;
    }

    /**
     * Get the value of Anecdote
     *
     * @return mixed
     */
    public function getAnecdote()
    {
        return $this->anecdote;
    }

    /**
     * Set the value of Anecdote
     *
     * @param mixed anecdote
     *
     * @return self
     */
    public function setAnecdote($anecdote)
    {
        $this->anecdote = $anecdote;

        return $this;
    }

    /**
     * Get the value of Wiki
     *
     * @return mixed
     */
    public function getWiki()
    {
        return $this->wiki;
    }

    /**
     * Set the value of Wiki
     *
     * @param mixed wiki
     *
     * @return self
     */
    public function setWiki($wiki)
    {
        $this->wiki = $wiki;

        return $this;
    }

}
