<header>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand big-title" href="#">O'Quiz</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <?php if ($user): ?>
                    <div class="navbar-nav ml-auto">
                        <div class="hello">Bonjour <?= $user->getFirstName() ?></div>
                        <a class="nav-item nav-link" href="<?= $router->generate('home')?>"><i class="fas fa-home"></i>Accueil</a>
                        <a class="nav-item nav-link" href="<?= $router->generate('compte')?>"><i class="fas fa-user"></i>Mon compte</a>
                        <a class="nav-item nav-link" href="<?= $router->generate('signout')?>"><i class="fas fa-sign-in-alt"></i>Déconnexion</a>
                    </div>
                <?php else: ?>
                    <div class="navbar-nav ml-auto">
                        <div class="hello pt-2">Bonjour</div>
                        <a class="nav-item nav-link" href="<?= $router->generate('home')?>"><i class="fas fa-home"></i>Accueil</a>
                        <a class="nav-item nav-link" href="<?= $router->generate('signup')?>"><i class="fas fa-edit"></i>Inscription</a>
                        <a class="nav-item nav-link" href="<?= $router->generate('signin')?>"><i class="fas fa-sign-in-alt"></i>Connexion</a>
                    </div>
                <?php endif; ?>
            </div>
        </nav>
    </div>
</header>
