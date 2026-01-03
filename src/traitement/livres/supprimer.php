<?php
session_start();
require_once(__DIR__ . '/../../../config.php');

if (!isset($_POST['id_livre'])) {
    header('Location: ../../../public/livres/listeLivre.php');
    exit();
}
$id_livre = (int) $_POST['id_livre']; /*etant donné qu'on travaille avec les id qui sont des Int
 il est recommande de precisé que id est un int  pour ignoré les chars/string dans l'url et securisé la bdd*/

    try {

        $sql = $pdo->prepare("DELETE FROM ecrire WHERE ref_livre = :id");
        $sql->execute(['id' => $id_livre]); //>> supp livre dans ecrire d'abord a cause de la contrainte de la clé etrangere


        $sql = $pdo->prepare("DELETE FROM livre WHERE id_livre = :id");
        $sql->execute(['id' => $id_livre]); //supp le livre dans table livre

    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }

header('location: ../../../public/livres/listeLivre.php');
exit();
?>
/* j'ai finalement choisi de pas faire de page html pour supprimer car c'est juste une action
Je peux la traiter juste avec le bouton supprimer dans la page liste*/
