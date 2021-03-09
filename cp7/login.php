<?php
// 1. Vérif et sécurisation des variables $_POST
if (isset($_POST['mail']) && !empty($_POST['mail'])) {
    $mail = htmlspecialchars($_POST['mail']);
}
if (isset($_POST['pass']) && !empty($_POST['pass'])) {
    $pass = htmlspecialchars($_POST['pass']);
}

// 2. Crypter l'adresse mail et le mot de passe
$mail = MD5($mail);
$pass = hash(sha1($pass) . $mail, 512);

// 3. Tester via connexion PDO si l'utilisateur existe
// SELECT COUNT(*) => 1 ou 0 / SELECT * => rowCount()
try {
    include_once('constants.php');
    $cnn = new PDO(
        'mysql:host=' . HOST . ';dbname=' . DB . ';charset=utf8',
        USER,
        PASS,
        array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        )
    );

    // Préparation et exécution requête
    $sql = "SELECT * FROM users WHERE mail=? AND pass=?";
    $qry = $cnn->prepare($sql);
    $vals = array($mail, $pass);
    $qry->execute($vals);
    // 3a. Si utilisateur reconnu alors router vers bo.php
    if ($qry->rowCount() === 1) {
        // Démarrage session et stockage variables de session
        session_start();
        $row = $qry->fetch();
        $_SESSION['connected'] = true;
        $_SESSION['session_id'] = session_id();
        $_SESSION['fname'] = $row['fname'];
        $_SESSION['mail'] = $_POST['mail'];
        // Route vers bo.php
        header('location:bo.php');
    } else {
        // Route vers index.php avec message
        header('location:index.php?c=1'); // 1 : login ou pass KO
    }

} catch (PDOException $err) {
    echo $err->getMessage();
}

// 3a. Si utilisateur reconnu alors router vers bo.php


// 3b. Sinon router vers index.php avec variable dans
// querystring -> afficher message dans index.php