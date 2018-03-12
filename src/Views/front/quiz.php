<?php $this->layout('layout'); ?>

<div class="container">
    <h1 class="font-weight-bold"><?= $quiz->getTitle() ?></h1>

    <p class="font-weight-bold"><?= $quiz->getDescription() ?></p>

    <div class="d-flex flex-wrap">

        <?php foreach ($questions as $question) :?>
            <?php if ($quiz->getId() == $question->getIdQuiz()): ?>
                <div class="card" style="width: 20rem">
                    <h5 class="card-header"><?= $question->getQuestion() ?></h5>
                    <ul>
                        <input class="form-check-input position-static" type="radio" name="blankRadio"><?= $question->shuffle() ?>
                    </ul>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <button type="button" class="btn btn-primary btn-lg btn-block">OK</button>
</div>
