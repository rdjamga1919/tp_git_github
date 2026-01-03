<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once(__DIR__ . '/../../../config.php');

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header('Location: ../../../public/livres/listeLivre.php');
    exit();
}

    $id_livre = $_POST['id_livre'];
    $titre = $_POST['titre'];
    $annee = $_POST['annee'];
    $resume = $_POST['resume'];
    $id_auteur = $_POST['id_auteur'];

    try {
        $sql = $pdo->prepare("UPDATE livre SET titre = :titre, annee = :annee, resume = :resume WHERE id_livre = :id");
        $sql->execute(['titre' => $titre, 'annee' => $annee, 'resume' => $resume, 'id' => $id_livre]);
        $stmt = $pdo->prepare("UPDATE ecrire SET ref_auteur = :ref_auteur WHERE ref_livre = :ref_livre");
        $stmt->execute(['ref_auteur' => $id_auteur, 'ref_livre' => $id_livre]);

        header('Location: ../../../public/livres/listeLivre.php');
        exit();

    } catch (PDOException $e) {
        header('Location: ../../../public/livres/modifierLivre.php?id=' . $id_livre . '&error=1');
        exit();
    }