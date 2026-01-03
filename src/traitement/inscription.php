<?php

require_once(__DIR__ . '/../../config.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom       = $_POST['nom'];
    $prenom    = $_POST['prenom'];
    $email     = $_POST['email'];
    $tel_fixe   = $_POST['tel_fixe'] ;
    $tel_portable = $_POST['tel_portable'];
    $cp        = $_POST['cp'] ;
    $rue       = $_POST['rue'] ;
    $ville     = $_POST['ville'] ;

    $stmt = $pdo->prepare("INSERT INTO inscrit (nom, prenom, email, tel_fixe, tel_portable, cp, rue, ville) 
        VALUES (:nom, :prenom, :email, :tel_fixe, :tel_portable, :cp, :rue, :ville)");

    $stmt->execute([
        'nom'       => $nom,
        'prenom'    => $prenom,
        'email'     => $email,
        'tel_fixe' => $tel_fixe,
        'tel_portable'   => $tel_portable,
        'cp'        => $cp,
        'rue'       => $rue,
        'ville'     => $ville
    ]);

    header("Location: ../public/index.php");
    exit();
}
