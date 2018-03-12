<?php $this->layout('layout'); ?>

<div class="container">
    <div class="row">
        <div class="col md-4">
            <h1>Mon compte</h1>
            <p> Prénom: <?= $user->firstname?></p>
            <p> Nom: <?= $user->lastname?></p>
        </div>
    </div>
</div>
