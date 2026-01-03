<?php
session_start();
require_once(__DIR__ . '/../../config.php');

if (isset($_GET['id'])) {
    $id_livre = $_GET['id'];

    try {

        $sql = $pdo->prepare("DELETE FROM ecrire WHERE ref_livre = :id");
        $sql->execute(['id' => $id_livre]); //>> supp livre dans ecrire d'abord a cause de la contrainte de la table etrangere


        $sql = $pdo->prepare("DELETE FROM livre WHERE id_livre = :id");
        $sql->execute(['id' => $id_livre]); //supp le livre dans table livre

    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
}

header('location: listeLivre.php');
exit();
?>