<?php
// Démarre ou restaure une session
session_start();
// Teste si une connexion est active
if (!isset($_SESSION['connected']) || !$_SESSION['connected']) {
    header('location:index.php?c=2');
    exit();
}