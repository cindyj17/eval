<?php

namespace Oquiz\Controllers;

class MainController extends CoreController{

    // Affiche la page d'accueil
    public function indexAction() {

        // On récupère la liste des quizzes
        // afin de pouvoir les transmettre au template
        $results = \Oquiz\Models\QuizModel::findAll();
        // On récupère le nom des auteurs
        $result = \Oquiz\Models\UserModel::findAll();

        // J'affiche le template "home.php"
        echo $this->templates->render(
            'main/home',
            [
                'quizzes' => $results,
                'users' => $result
            ]
        );
    }

    // Affiche la page 404
    public function error404() {

        // J'affiche le template "404.php"
        echo $this->templates->render('main/404');
    }
}
