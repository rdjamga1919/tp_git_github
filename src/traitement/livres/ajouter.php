<?php
/*var_dump($_POST);
die();*/
session_start();
require_once(__DIR__ . '/../../../config.php');

//le if sert a demander si on a soumis le formulaire pour pouvoir l'inserer dans la bdd
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre = $_POST['titre'];
    $annee = $_POST['annee'];
    $resume = $_POST['resume'];
    $id_auteur = $_POST['id_auteur'];

    try {
        $sql = $pdo->prepare("INSERT INTO livre (titre,annee, resume) 
            VALUES (:titre, :annee, :resume)");
        $sql->execute([
            'titre' => $titre,
            'annee' => $annee,
            'resume' => $resume,
        ]); //pour inserer le livre dans bdd

        $id_livre =  $pdo->lastInsertId(); //recup le nouvel id du livre

        $sql = $pdo->prepare("INSERT INTO ecrire (ref_livre, ref_auteur)
            VALUES (:ref_livre, :ref_auteur)");
        $sql->execute([
            'ref_livre' => $id_livre,
            'ref_auteur' => $id_auteur,
        ]); // permet de lier le nouveau livre et l'auteur dans la table ecrire de la bdd

        header("location: ../../../public/livres/listeLivre.php");
        exit();
    } catch (PDOException $e) {
        header('Location: ../../../public/livres/ajouterLivre.php?error=db');
        exit();
    }
    /*nb : -> permet d'acceder a qqch (a une methode = type de fontion defini a linterieur d'une classe. ou acceder a une propriete) sur un objet (ici $pdo mon objet)
exemple : $stmt (nom de variable statement qui va etre appeler par la suite) = $pdo (objet défini dans bdd.php) -> (appelle la methode prepare) prepare (methode php qui prend une requetes sql avec des paramettres (ici etiquettes :titre...) et renvoi un autre objet)
syntaxe generale :
$objet->methode();
$objet->propriete;
*/
}