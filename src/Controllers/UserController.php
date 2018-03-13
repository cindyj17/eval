<?php

namespace Oquiz\Controllers;

class UserController extends CoreController
{

    //Page de connexion
    public function signin()
    {
        $errors = [];

        if (!empty($_POST)) {
            // Un visiteur essaie de se connecter
            // On vérifie l'email + mot de passe
            // pour savoir si le compte existe bien
            $email = $_POST['email'];
            $password = $_POST['password'];

            // On vérifie si le compte existe
            $user = \Oquiz\Models\UserModel::checkAccount($email, $password);

            if (!$user) {

                // C'est pas bon, on s'arrête là
                $errors[] = 'Le compte n\'existe pas';
            } else {

                // On connecte notre utilisateur
                \Oquiz\Models\UserModel::connect($user);
                $this->redirect('home');
            }
        }

        // On affiche le template
        $this->render('user/signin', ['errors' => $errors]);
    }

    // Déconnexion
    public function logout()
    {
        \Oquiz\Models\UserModel::disconnect();
        $this->redirect('home');
    }


    // Page de profil
    public function read()
    {
        // On récupère l'utilisateur à partir de son ID
        $user = \Oquiz\Models\UserModel::getUser();

        // On transmet les informations de l'utilisateur au template
        $this->render(
            'user/read',
            [
                'user' => $user
            ]
        );
    }

}
