<?php
try {
    // ⚠️ adapte host, dbname, user, password à ta configuration
    $pdo = new PDO("mysql:host=localhost;dbname=joe;charset=utf8", "joe", "lovebooks");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $titre  = $_POST['titre'] ?? '';
        $auteur = $_POST['auteur'] ?? '';
        $annee  = $_POST['annee'] ?? null;
        $genre  = $_POST['genre'] ?? '';

        $stmt = $pdo->prepare("INSERT INTO livres (titre, auteur, annee, genre) 
                               VALUES (:titre, :auteur, :annee, :genre)");
        $stmt->execute([
            'titre'  => $titre,
            'auteur' => $auteur,
            'annee'  => $annee,
            'genre'  => $genre
        ]);

        // ✅ Redirection vers index.php après succès
        header("Location: index.php?ajout=success");
        exit();

        ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un livre</title>
</head>
<body>
<h1>Ajouter un livre</h1>
<form method="POST" action="traitement_livre.php">
    <label for="titre">Titre :</label><br>
    <input type="text" id="titre" name="titre" required><br><br>

    <label for="auteur">Auteur :</label><br>
    <input type="text" id="auteur" name="auteur" required><br><br>

    <label for="annee">Année :</label><br>
    <input type="number" id="annee" name="annee"><br><br>

    <label for="genre">Genre :</label><br>
    <input type="text" id="genre" name="genre"><br><br>

    <button type="submit">Ajouter</button>
</form>
</body>
</html>
