<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=joe', 'joe', 'lovebooks');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM information WHERE id = ?";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$id]);
}


header("Location: connexion.php");
?>