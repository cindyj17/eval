<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Oquiz</title>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <!-- Font awesome -->
        <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
        <!-- style.css -->
        <link rel="stylesheet" href="<?= $baseUrl ?>/public/css/style.css">
    </head>
    <body>

        <!-- L'entête de l'application avec le Menu -->
        <?php $this->insert('partials/header') ?>

        <!-- Là où sera injecté le contenu du template -->
        <?=$this->section('content')?>

        <!-- Le footer de l'application -->
        <?php $this->insert('partials/footer') ?>

        <!-- Bootstrap -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    </body>
</html>
