<?php
global $pdo;
require_once('../bdd/bdd.php');
session_start();

if (isset($_POST['identifiant']) && isset($_POST['mot_de_passe'])) {
    $identifiant = $_POST['identifiant'];
    $mot_de_passe = $_POST['mot_de_passe'];

    $stmt = $pdo->prepare("SELECT * FROM inscrit WHERE login = :identifiant and mdp = :mot_de_passe");
    $stmt->execute(['identifiant' => $identifiant
    , 'mot_de_passe' => $mot_de_passe]);
    $user = $stmt->fetch();

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['identifiant'] = $user['login'];
        header("Location: index.php");
        exit();
    } else {
        echo "Identifiant ou mot de passe incorrect.";
    }
    header("Location: formulaire.html");
}