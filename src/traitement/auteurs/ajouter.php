<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=joe;charset=utf8", "joe", "lovebooks");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $nom            = $_POST['nom'] ;
        $prenom         = $_POST['prenom'] ;
        $date_naissance = $_POST['date_naissance'];
        $pays           = $_POST['pays'];

        // Vérifier si le pays existe déjà
        $stmt = $pdo->prepare("SELECT id_pays FROM pays WHERE nom = :nom");
        $stmt->execute(['nom' => $pays]);
        $existing = $stmt->fetch();

        if ($existing) {
            $ref_pays = $existing['id_pays'];
        } else {
            // Insérer le nouveau pays
            $stmt = $pdo->prepare("INSERT INTO pays (nom) VALUES (:nom)");
            $stmt->execute(['nom' => $pays]);
            $ref_pays = $pdo->lastInsertId();
        }

        // Insérer l’auteur
        $stmt = $pdo->prepare("INSERT INTO auteur (nom, prenom, date_naissance, ref_pays) 
                               VALUES (:nom, :prenom, :date_naissance, :ref_pays)");
        $stmt->execute([
            'nom'            => $nom,
            'prenom'         => $prenom,
            'date_naissance' => $date_naissance,
            'ref_pays'       => $ref_pays
        ]);

        // ✅ Redirection vers index.php après succès
        header("Location: ../public/index.php");
        exit();
    }
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
  <title>Ajouter un auteur</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<h1>Ajouter un nouvel auteur</h1>
<form method="POST" action="ajouter.php">
    <label for="nom">Nom :</label><br>
    <input type="text" id="nom" name="nom" required><br><br>

    <label for="prenom">Prénom :</label><br>
    <input type="text" id="prenom" name="prenom" required><br><br>

    <label for="pays">Pays :</label><br>
    <input type="text" id="pays" name="pays" required><br><br>

    <label for="date_naissance">Date de naissance :</label><br>
    <input type="date" id="date_naissance" name="date_naissance"><br><br>

    <button type="submit">Ajouter</button>
    <a href="../public/index.php"></a>
</form>
</body>
</html>