<?php $this->layout('layout'); ?>

<div class="container">
    <h1 class="font-weight-bold"><?= $quiz->getTitle() ?></h1>

    <p class="font-weight-bold"><?= $quiz->getDescription() ?></p>

    <div class="d-flex flex-wrap">

        <?php foreach ($questions as $question) :?>
            <?php if ($quiz->getId() == $question->getIdQuiz()): ?>
                <div class="card" style="width: 20rem">
                    <h5 class="card-header"><?= $question->getQuestion() ?></h5>
                    <div class="card-body">
                        <ol>
                            <li><?= $question->shuffle() ?></li>
                        </ol>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>


</div>
