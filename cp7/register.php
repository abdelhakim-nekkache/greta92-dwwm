<?php
// Tester avec MYSQLI si le user est reconnu ou pas :

// 1. connexion à bdd
$cnn = mysqli_connect('localhost', 'root', 'greta', 'northwind');
if (mysqli_connect_errno()) {
  printf('Erreur de connexion : %s', mysqli_connect_error());
  exit();
}

// 2. requête préparée pour vérifier si mail trouvé
$qry = mysqli_stmt_init($cnn);
$sql = 'SELECT COUNT(*) AS nb FROM users WHERE mail=?';
if (mysqli_stmt_prepare($qry, $sql)) {
  $hash = MD5(htmlspecialchars($_POST['mail']));
  mysqli_stmt_bind_param($qry, 's', $hash);
  mysqli_stmt_execute($qry);
  mysqli_stmt_bind_result($qry, $nb);
  mysqli_stmt_fetch($qry);
  mysqli_stmt_close($qry);
}

if ($nb === 1) {
  // 2a. si oui alors afficher message d'erreur
  echo 'Ce compte existe déjà : ' . $_POST['mail'];
} else {
  // 2b. si non alors créer un nouvel user avec role app_read
  // 2b1 create user
  $qry = mysqli_stmt_init($cnn);
  $sql = 'INSERT INTO users(mail, fname, pass, land, active) VALUES(?, ?, ?, ?, ?)';
  if (mysqli_stmt_prepare($qry,$sql)){
      $mail   = MD5(htmlspecialchars($_POST['mail']));
      $fname  = htmlspecialchars($_POST['fname']);
      $pass   = hash('sha512',sha1(htmlspecialchars($_POST['pass']),false).$mail,false);
      $land   = htmlspecialchars($_POST['land']);
      $active = 0;
      mysqli_stmt_bind_param($qry, 'ssssi', $mail, $fname, $pass, $land, $active);
      $res = mysqli_stmt_execute($qry);
      mysqli_stmt_close($qry);

      // Envoie d'un mail pour confirmation du succés
      if($res){
        $html       = '<h1>Inscription Northwind Traders';
        $html      .= '<p>Bonjour '.$_POST['fname'].' et bienvenu(e) sur notre site.';
        $html      .= '<p>Clique sur le lien suivant pour valider ton inscription : http://'.$_SERVER['HTTP_HOST'].'/colombes/cp7/register2.php?m=' . $mail;
        $html      .= '<p>A trés bientôt';
        // En-tête du mail
        $header         = "MIME-version: 1.0\n";                               // Version MIME
        $header        .= "Content-type: text/html; charset=utf-8 \n";         // Format du mail
        $header        .= "From: marie@noelle.fr \n";                          // Expéditeur
        $header        .= "Reply-to: manu@elysees.gouv.fr \n";                 // Destinataire de la réponse
        $header        .= "Disposition-Notification-To: hakim.78@icloud.com";  // Accusé de réception
        $header        .= "X-Priority: 1 \n";                                  // Activation importance
        $header        .= "X-MSMail-Priority: High \n";                        // MS
        // Envoi du mail
        // Pour linux, installer un serveur de messagerie : http://www.postfix.org/
        // ini_set('SMTP', 'ss10.ovh.net');
        // ini_set('sendmail_from', 'walterwhite75@icloud.com'); // windows only
        ini_set('sendmail_path', '/chemin sendmail.exe'); //linux only

        mail($_POST['mail'],'Northwind Traders', $html, $header);
        echo ($res2 ? 'Scuccés' : 'Echec');
      }else{
          echo 'Echec dans l\'ajout du user.';
      }
    }
}

mysqli_close($cnn);






// sendmail.ini
// [sendmail]
// smtp_server= ton mail
// smtp_port=465
// error_logfile=error.log
// debug_logfile=debug.log
// auth_username=xxx@yahoo.fr
// auth_password=xxx
// force_sender=xxx@yahoo.fr
// pour windows