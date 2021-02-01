<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Northwind Traders | Accueil</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>

<body class="container">

    <h2>SERVER</h2>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Clé</th>
                <th>Valeur</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $html = "";
            foreach ($_SERVER as $key => $val) {
                $html .= sprintf('<tr><td>%s</td><td>%s</td></tr>', $key, $val);
            }
            echo $html;

            ?>

        </tbody>
    </table>

    <h2>REQUEST</h2>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Clé</th>
                <th>Valeur</th>
            </tr>
        </thead>
        <tbody>

            <?php

            setcookie("granola", "Toto aime le choco");
            setcookie("prince", "Chanteur pop des années 80", time() + 365 * 24 * 60 * 60, "/");
            $html = "";
            foreach ($_REQUEST as $key => $val) {
                $html .= sprintf('<tr><td>%s</td><td>%s</td></tr>', $key, $val);
            }
            echo $html;

            ?>

        </tbody>
    </table>

    <h2>GET</h2>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Clé</th>
                <th>Valeur</th>
            </tr>
        </thead>
        <tbody>

            <?php

            $html = "";
            foreach ($_GET as $key => $val) {
                $html .= sprintf('<tr><td>%s</td><td>%s</td></tr>', $key, $val);
            }
            echo $html;

            ?>

        </tbody>
    </table>

    <h2>SESSION</h2>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Clé</th>
                <th>Valeur</th>
            </tr>
        </thead>
        <tbody>

            <?php

            session_start();
            $_SESSION['login time'] = time();
            $_SESSION['fname'] = 'JM';
            $_SESSION['admin'] = true;
            $html = "";
            foreach ($_SESSION as $key => $val) {
                $html .= sprintf('<tr><td>%s</td><td>%s</td></tr>', $key, $val);
            }
            echo $html;
            
            ?>

        </tbody>
    </table>

</body>

</html>