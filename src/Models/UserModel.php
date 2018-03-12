<?php

namespace Oquiz\Models;

class UserModel{

    protected static $tablename = 'users';
    protected static $orderBy = 'first_name';

    protected $id;
    protected $first_name;
    protected $last_name;
    protected $email;
    protected $password;

public static function findAll() {

    // On récupère la connexion à la BDD
    $conn = \Oquiz\Utils\Database::getDB();

    // On crée la requête SQL de récupération des données
    $sql = 'SELECT * FROM users';

    // On exécute la requête
    $stmt = $conn->query($sql);

    // On récupère tous les résultats
    return $stmt->fetchAll(\PDO::FETCH_CLASS, '\Oquiz\Models\UserModel');
}

  // Vérifie si le compte existe,
    //et retourne les données du compte
    public static function checkAccount( $email, $password) {

        // On récupère toutes les données de l'utilisateur
        // qui possède cette adresse mail. Si il
        // n'existe pas, ça retourne "false"
        $user = self::findByMail( $email );

        if ($user) {

            // On a bien un utilisateur qui correspond
            //password_verify( $typedPassword, $dbPassword)
            $isOk = password_verify( $password, $user->getPassword());

            if ($isOk) {

                // Le mot de passe est le bon, on continue
                return $user;
            }
            else {

                // Mauvais mot de passe, on arrête
                return false;
            }
        }
        else {

            // Adresse mail inconnue
            return false;
        }
    }

  public static function findByMail( $email ) {

        // On récupère la connexion à la BDD
        $conn = \Oquiz\Utils\Database::getDB();

        // On construit une requ SQL
        $sql = 'SELECT * FROM users WHERE email LIKE :email';

        // On prépare notre requête
        $stmt = $conn->prepare( $sql );
        $stmt->bindValue(':email', $email, \PDO::PARAM_STR);

        // On exécute la requête
        $stmt->execute();

        // On récupère le résultat
        $stmt->setFetchMode(\PDO::FETCH_CLASS, static::class);
        return $stmt->fetch(\PDO::FETCH_CLASS);
    }


    // Crée la session de l'utilisateur
    public static function connect($user) {

        // On va stocker en SESSION les différentes
        $_SESSION['user'] = [
            'id'=> $user->getId(),
            'firstname' => $user->getFirstname(),
            'lastname' => $user->getLastname(),
        ];
    }

    //Indique si l'utilisateur est connecté ou pas
    public static function isConnected() {

        return isset( $_SESSION['user'] );
    }

    // Déconnecte l'utilisateur
    public static function disconnect() {

        // On supprime les données de l'utilisateur en session
        unset($_SESSION['user']);
        // On supprime même tout ce qui reste dans les sessions
        // Concrêtement ça supprime le cookie
        session_destroy();
    }

    // Retourne les informations de l'utilisateur
    public static function getUser() {

        // Si l'utilisateur n'est pas connecté,
        // on retourne la valeur "false"
        if (!isset($_SESSION['user'])) return false;

        return (object) $_SESSION['user'];
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
     * Get the value of First Name
     *
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Set the value of First Name
     *
     * @param mixed first_name
     *
     * @return self
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;

        return $this;
    }

    /**
     * Get the value of Last Name
     *
     * @return mixed
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Set the value of Last Name
     *
     * @param mixed last_name
     *
     * @return self
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;

        return $this;
    }

    /**
     * Get the value of Email
     *
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of Email
     *
     * @param mixed email
     *
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of Password
     *
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of Password
     *
     * @param mixed password
     *
     * @return self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

}
