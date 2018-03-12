<?php $this->layout('layout'); ?>


<div class="container">
    <div class="row">
        <div class="area col-md-6 m-auto">
            <h1>Page de connexion</h1>
            <form id="signin-form" action="<?= $router->generate('signin')?>" method="post">
                <div class="form-group">
                    <label for="email">Ton email</label>
                    <input
                    id="email"
                    type="text"
                    name="email"
                    class="form-control"
                    placeholder="jon@snow.com"
                    value=""
                    >
                </div>
                <div class="form-group">
                    <label for="password">Ton mot de passe</label>
                    <input
                    id="password"
                    type="password"
                    name="password"
                    class="form-control"
                    placeholder="azerty"
                    value=""
                    >
                </div>
                <input type="submit" class="btn btn-primary" value="Se connecter">
            </form>
        </div>

    </div>

</div>
