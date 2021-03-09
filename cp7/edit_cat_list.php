<?php
// pagination : on récupère la page active, s'il y en a une (sinon on le fixe à 1) 
if (isset($_GET['pg']) && !empty($_GET['pg'])) {
    $pg = (int) $_GET['pg'];
} else {
    $pg = 1;
}

// pagination #2 : on récupère le nb de lignes "visibles", si existe
if (isset($_GET['nb']) && !empty($_GET['nb'])) {
    $nb = (int) $_GET['nb'];
} else {
    $nb = 5;
}

// connexion à la BDD via MYSQLI (avec verif)
$start = ($pg - 1) * $nb;
$cnn = mysqli_connect('localhost', 'root', 'greta', 'northwind');
if (mysqli_connect_errno()) {
    printf("Erreur de connexion : %s", mysqli_connect_error());
    exit();
}
// on récupère la liste des catégories de la BDD 'Northwind'
$res = mysqli_query($cnn, "SELECT * FROM categories LIMIT {$start}, {$nb}");
?>



<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Northwind Traders | Accueil</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>

<body class="container">

    <h1>Liste des catégories</h1>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
            <li class="breadcrumb-item active" aria-current="page">Catégories</a></li>
        </ol>
    </nav>

    <a href="edit_cat_form.php" class="btn btn-success mt-5 mb-3">Ajouter une nouvelle catégorie</a>

    <table class="table table-dark table-striped">
        <thead>
            <tr>

                <?php
                // on affiche la liste des colonnes
                $html = "";
                while ($col = mysqli_fetch_field($res)) {
                    $html .= "<th>{$col->name}</th>";
                }
                echo $html;
                ?>

            </tr>
        </thead>
        <tbody>

            <?php
            // on affiche les datas de chaque colonne 
            $html = "";
            while ($row = mysqli_fetch_row($res)) {
                $html .= '<tr>';
                foreach ($row as $key => $val) {
                    if ($key === 0) {
                        $html .= '<td><a href="edit_cat_form.php?k=' . $val . '">' . $val . '</a></td>';
                    }
                    // si c'est du BLOB 
                    elseif (strpos($val, ";base64,")) {
                        $html .= '<td><img src="' . $val . '" width="150px" /></td>';
                    } else {
                        $html .= "<td>{$val}</td>";
                    }
                }
                $html .= '</tr>';
            }
            echo $html;
            ?>

        </tbody>
    </table>

    <nav>
        <ul class="pagination justify-content-center">

            <?php

            // calcul du nb de pages de la pagination 
            $res = mysqli_query($cnn, "SELECT COUNT(*) AS total FROM categories");
            $row = mysqli_fetch_assoc($res);
            $pgs = ceil($row['total'] / $nb);

            // affichage de la pagination calculée
            $html = "";

            // test previous / next #1
            $href = $_SERVER['PHP_SELF'] . '?pg=' . ($pg - 1) . '&nb=' . $nb;
            $html .= '<li class="page-item"><a class="page-link" href="' . $href . '" aria-label="Next"><span aria-hidden="true">&laquo;</span></a></li>';

            for ($i = 1; $i <= $pgs; $i++) {
                $href = $_SERVER['PHP_SELF'] . '?pg=' . $i  . '&nb=' . $nb;
                $html .= '<li class="page-item ' . ($pg === $i ? 'active' : '') . '"><a class="page-link" href="' . $href . '">' . $i . '</a></li>';
            }

            // test previous / next #2 
            $href = $_SERVER['PHP_SELF'] . '?pg=' . ($pg + 1) . '&nb=' . $nb;
            $html .= '<li class="page-item"><a class="page-link ' . ($pg > $i ? 'disabled' : '') . '" href="' . $href . '" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';

            echo $html;


            ?>

        </ul>
    </nav>


</body>

</html>