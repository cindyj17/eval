<?php

namespace Oquiz\Controllers;

class UserController extends CoreController {

  //Page de connexion
    public function signin() {

        $errors = [];

        if (!empty($_POST)) {

            // Un visiteur essaie de se connecter
            // On vérifie l'email + mot de passe
            // pour savoir si le compte existe bien
            $email = $_POST['email'];
            $password = $_POST['password'];

            // On vérifie si le compte existe
            $user = \Oquiz\Models\UserModel::checkAccount( $email, $password );

            if (!$user) {

                // C'est pas bon, on s'arrête là
                $errors[] = 'Le compte n\'existe pas';
            }
            else {

                // On connecte notre utilisateur
                \Oquiz\Models\UserModel::connect( $user );
                header('Location: '. $this->router->generate('home'));
                exit();
            }
        }

        // On affiche le template
        echo $this->templates->render('user/signin', ['errors' => $errors]);
    }

    // Déconnexion
    public function logout() {

        \Oquiz\Models\UserModel::disconnect();
        header('Location: ' . $this->router->generate( 'home' ));
    }


    // Page de profil
    public function read() {

        // On récupère l'utilisateur à partir de son ID
        $user = \Oquiz\Models\UserModel::getUser(  );
dump($user);
        // On transmet les informations de l'utilisateur au template
        echo $this->templates->render('user/read',
        [
            'user' => $user
        ]
    );
    }

}
