<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Northwind Traders | Accueil</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body class="container">
    <div class="jumbotron">
        <h1 class="display-4">Northwind Traders</h1>

        <?php

        include_once('team.php');
        define("FNAME", $members[11][0]);
        $diff = (strtotime(date('Y-m-d')) - strtotime('2020/11/02')) / 60 / 60 / 24;
        echo '<p class="lead">Projet réalisé par ' . FNAME . ', Daron Codeur depuis ' . $diff . ' jours.</p>';

        ?>

        <hr class="my-4">
        <p>Cliquer sur le bouton ci-dessous pour accéder au back-office :</p>
        <a class="btn btn-success btn-lg" href="#" role="button">Connexion</a>
    </div>

    <h2>Notre équipe</h2>

    <section id="team" class="d-flex flex-wrap justify-content-between">

        <?php
        // include_once('team.php');
        // la ligne ci-dessus n'est plus utile car on l'utilise finalement plus haut dans le code (ligne 18)
        $html = "";
        for ($i = 0; $i < count($members); $i++) {
            $html .= '<div class="card mb-3 ' . ($members[$i][2] === "F" ? "girl" : "boy") . '" style="width: 18rem;">';
            $html .= '<div class="card-body">';
            $html .= '<h5 class="card-title">' . $members[$i][0] . '</h5>';
            $html .= '<p class="card-text">' . $members[$i][1] . ' ans</p>';
            // $html .= '<p class="card-text"> marié(e) : '. $members[$i][3] .'</p>';
            // la ligne précédente renvoie "1" pour les personnes mariées 
            // ('true' dans le tableau '$members' du fichier 'team.php')
            // mais reste vide quand 'false' ; 
            // je décide donc de rajouter la fonction 'str_replace()' (qui prend 3 paramètres : ce qu'on cherche, par quoi on remplace, et où on cherche)
            // $html .= '<p class="card-text"> marié(e) : '. str_replace(true, "oui", $members[$i][3]) .'</p>';
            // cela fonctionne bien pour le 'true' mais pas pour le 'false' car 'true' renvoie '1' et false '' 
            // je décide finalement de faire un if else : 

            /*
            if ($members[$i][3]) {
                $html .= '<p class="card-text"> marié(e) : oui</p>';
            } else {
                $html .= '<p class="card-text"> Célibataire</p>';
            };
            */
            /*
            // variante de mon if en mode 'ternaire' pour gérer "marié" ou "mariéE" :
            if($members[$i][3]) {
                $html .= ($members[$i][2] === "F" ? '<p class="card-text"> Mariée</p>' : '<p class="card-text"> Marié</p>' );
            } else {
                $html .= '<p class="card-text"> Célibataire</p>';
            };
            */
            // variante de mon if en mode 'ternaire' dans un 'ternaire' pour éliminer le 'if' :
            $html .= '<p class="card-text"> ' . ($members[$i][3] ? ($members[$i][2] === "F" ? "Mariée" : "Marié") : "Célibataire") . '</p>';

            $html .= '</div></div>';
        }
        echo $html;

        ?>

    </section>

    <h2>Nos références</h2>

    <section id="projects">

        <?php
            include_once('projects.php');
        ?>

    </section>

</body>

</html>
