<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=joe', 'joe', 'lovebooks');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}
session_start();
if (isset($_POST['identifiant']) && isset($_POST['mot_de_passe'])) {
    $identifiant = $_POST['identifiant'];
    $mot_de_passe = $_POST['mot_de_passe'];

    $stmt = $bdd->prepare("SELECT * FROM inscrit WHERE login = :identifiant");
    $stmt->execute(['identifiant' => $identifiant]);
    $user = $stmt->fetch();

    if ($user && password_verify($mot_de_passe, $user['mot_de_passe'])) {
        // Connexion réussie
        $_SESSION['user_id'] = $user['id_inscrit'];
        $_SESSION['identifiant'] = $user['identifiant'];


        header("Location: index.php");
        exit();
    } else {

        header("Location: formulaire.html?error=1");
        exit();
    }
}