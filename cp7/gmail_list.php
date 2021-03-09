<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Northwind Traders</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
</head>

<body class="container">
<h1>Accès boite au lettres Gmail</h1>
<table class="table table-striped">
        <thead>
        <th>DE</th>
        <th>OBJET</th>
        <th>RECU LE</th>
        <th>TAILLE</th>
    </thead>
    <tbody>
        <?php
            // Import
            include_once('constantes.php');
            // Tentative de connexion à la BAL
            $inbox = imap_open(MB_HOST,MB_USER,MB_PASS) or die('<div class="alert alert-danger">Connexion au serveur de messagerie impossible : '. imap_last_error() .'</div>');
            // Récupère tour les emails
            $emails = imap_search($inbox, 'ALL');
            // S'il ya des emails
            if ($emails){
                $html = '';
                // trie les mails du plus récent au plus ancien
                rsort($emails);
                // Pour chaque mails
                foreach ($emails as $id){
                    // Lit les infos de l'email
                          $emails = imap_fetch_overview($inbox, $id);
                    $html .= '<tr style="font-weight:'.($emails[0]->seen? '' : 'bold') . '" >';
                    $html .= '<td>'. imap_utf8($emails[0]->from) .'</td>';
                    $html .= '<td><a href="gmail_read.php?id='.$id.'">'. imap_utf8($emails[0]->subject) .'</a></td>';
                    $html .= '<td>'. date('Y-m-d H:i:s',$emails[0]->udate) .'</td>';
                    $html .= '<td>'. round($emails[0]->size / 1024) .' Ko</td>';
                }
                echo $html;
            }
            // Ferme la connexion
            imap_close($inbox);
        ?>
        <a href=""></a>
    </tbody>
</table>


</body>


</html>