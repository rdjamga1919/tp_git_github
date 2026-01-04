<?php
session_start();

try {
    $pdo = new PDO("mysql:host=localhost;dbname=joe;charset=utf8", "joe", "lovebooks");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $nom       = $_POST['nom'] ;
        $prenom    = $_POST['prenom'] ;
        $email     = $_POST['email'] ;
        $telephone = $_POST['telephone'] ;
        $adresse   = $_POST['adresse'] ;
        $cp        = $_POST['cp'] ;
        $rue       = $_POST['rue'] ;
        $ville     = $_POST['ville'] ;

        $stmt = $pdo->prepare("INSERT INTO inscrit 
            (nom, prenom, email, telephone, adresse, cp, rue, ville) 
            VALUES (:nom, :prenom, :email, :telephone, :adresse, :cp, :rue, :ville)");

        $stmt->execute([
            'nom'       => $nom,
            'prenom'    => $prenom,
            'email'     => $email,
            'telephone' => $telephone,
            'adresse'   => $adresse,
            'cp'        => $cp,
            'rue'       => $rue,
            'ville'     => $ville
        ]);

        header("Location: ../public/index.php");
        exit();
    }
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}