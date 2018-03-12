<?php

namespace Oquiz\Controllers;

class QuizController extends CoreController{

    // Affiche les quiz
    public function read($params) {

        // On récupère l'Id du quiz à afficher
        $id = $params['id'];

        // On récupère le quiz
        $result = \Oquiz\Models\QuizModel::findById( $id );
        // On récupère les questions correspondant au quiz
        $results = \Oquiz\Models\QuestionModel::findAll();

        // On transmet les informations du quiz au template
        echo $this->templates->render('front/quiz',
        [
            'quiz' => $result,
            'questions' => $results,
        ]
    );
    }
}
