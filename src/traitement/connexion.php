<?php
global $pdo;
require_once('../bdd/bdd.php');
session_start();

// Vérifie si on veut se connecter
if (isset($_POST['identifiant']) && isset($_POST['mot_de_passe'])) {
    $identifiant = $_POST['identifiant'];
    $mot_de_passe = $_POST['mot_de_passe'];

    $stmt = $pdo->prepare("SELECT * FROM inscrit WHERE login = :identifiant");
    $stmt->execute(['identifiant' => $identifiant]);
    $user = $stmt->fetch();

    if ($user && password_verify($mot_de_passe, $user['mot_de_passe'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['identifiant'] = $user['login'];
        header("Location: index.php");
        exit();
    } else {
        echo "Identifiant ou mot de passe incorrect.";
    }
    header("Location: formulaire.html");
}