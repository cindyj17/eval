<?php $this->layout('layout'); ?>

<div class="container">
<h1 class="font-weight-bold">Bienvenue sur O'Quiz</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>


<!-- J'affiche les quiz -->

    <div class="row justify-content-start">
        <?php foreach ($quizzes as $quiz) : ?>
        <div class="col-12 col-md-4">
            <h2 class="title font-weight-bold">

                <?php if ($user): ?>
                    <a href="<?= $router->generate('list-form', ['id' =>$quiz->getId()])?>"><?= $quiz->getTitle() ?></a>
                <?php else: ?>
                    <a href="<?= $router->generate('quiz', ['id' =>$quiz->getId()])?>"><?=  $quiz->getTitle() ?></a>
                <?php endif; ?>
                
            </h2>
            <p><?= $quiz->getDescription() ?></p>

            <?php foreach ($users as $user) : ?>
                <?php if ($quiz->getIdAuthor() == $user->getId()): ?>
                    <p>by <?= $user->getFirstName() ?> <?= $user->getLastName() ?></p>
                <?php endif; ?>
            <?php endforeach; ?>

        </div>
    <?php endforeach; ?>
    </div>
</div>
