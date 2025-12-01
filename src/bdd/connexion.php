<?php
try{
$bdd = new PDO('mysql:host=localhost;dbname=joe', 'joe',  'lovebooks');
}catch(PDOException $e) {
    echo "Erreur:" . $e->getMessage();
}
// pour recupérer les infos de l'utilisateur
$log = $pdo->prepare("SELECT * FROM inscrit WHERE identifiant = :identifiant");
$log->execute(['identifiant' => $identifiant]);
$user = $log->fetch();

if ($user && password_verify($mot_de_passe, $user['mot_de_passe'])) {
    // pour si la connexion est resussi réussie
    $_SESSION['user_id'] = $user['id'];
    echo "Bienvenue " . $user['identifiant'];
} else {
    echo "Identifiant ou mot de passe incorrect.";
}
header("Location: formulaire.html");
echo '<td><button><a href="formulaire.html">Ajouter un étudiant</button></a></td>';