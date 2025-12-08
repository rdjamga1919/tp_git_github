<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=joe;charset=utf8", "joe", "lovebooks");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Si formulaire soumis
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $id             = $_POST['id'] ?? null;
        $nom            = $_POST['nom'] ?? '';
        $prenom         = $_POST['prenom'] ?? '';
        $date_naissance = $_POST['date_naissance'] ?? null;
        $pays_nom       = $_POST['pays'] ?? '';

        // Vérifier/insérer le pays
        $stmt = $pdo->prepare("SELECT id_pays FROM pays WHERE nom = :nom");
        $stmt->execute(['nom' => $pays_nom]);
        $existing = $stmt->fetch();

        if ($existing) {
            $ref_pays = $existing['id_pays'];
        } else {
            $stmt = $pdo->prepare("INSERT INTO pays (nom) VALUES (:nom)");
            $stmt->execute(['nom' => $pays_nom]);
            $ref_pays = $pdo->lastInsertId();
        }

        if ($id) {
            // ✅ Mise à jour si id existe
            $stmt = $pdo->prepare("UPDATE auteur 
                                   SET nom = :nom, prenom = :prenom, date_naissance = :date_naissance, ref_pays = :ref_pays 
                                   WHERE id = :id");
            $stmt->execute([
                'nom'            => $nom,
                'prenom'         => $prenom,
                'date_naissance' => $date_naissance,
                'ref_pays'       => $ref_pays,
                'id'             => $id
            ]);
            header("Location: index.php?modif=success");
        } else {
            // ✅ Ajout si pas d’id
            $stmt = $pdo->prepare("INSERT INTO auteur (nom, prenom, date_naissance, ref_pays) 
                                   VALUES (:nom, :prenom, :date_naissance, :ref_pays)");
            $stmt->execute([
                'nom'            => $nom,
                'prenom'         => $prenom,
                'date_naissance' => $date_naissance,
                'ref_pays'       => $ref_pays
            ]);
            header("Location: index.php?ajout=success");
        }
        exit();
    }

    // Si GET avec id → charger l’auteur
    $auteur = null;
    if (isset($_GET['id'])) {
        $stmt = $pdo->prepare("SELECT a.*, p.nom AS pays_nom 
                               FROM auteur a 
                               LEFT JOIN pays p ON a.ref_pays = p.id_pays 
                               WHERE a.id = :id");
        $stmt->execute(['id' => $_GET['id']]);
        $auteur = $stmt->fetch();
    }

} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= $auteur ? "Modifier un auteur" : "modifier un auteur" ?></title>
</head>
<body>
<h1><?= $auteur ? "Modifier un auteur" : "modifier un auteur" ?></h1>

<form method="POST" action="modifie.php">
    <?php if ($auteur): ?>
        <input type="hidden" name="id" value="<?= htmlspecialchars($auteur['id']) ?>">
    <?php endif; ?>

    <label for="nom">Nom :</label><br>
    <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($auteur['nom'] ?? '') ?>" required><br><br>

    <label for="prenom">Prénom :</label><br>
    <input type="text" id="prenom" name="prenom" value="<?= htmlspecialchars($auteur['prenom'] ?? '') ?>" required><br><br>

    <label for="pays">Pays :</label><br>
    <input type="text" id="pays" name="pays" value="<?= htmlspecialchars($auteur['pays_nom'] ?? '') ?>" required><br><br>

    <label for="date_naissance">Date de naissance :</label><br>
    <input type="date" id="date_naissance" name="date_naissance" value="<?= htmlspecialchars($auteur['date_naissance'] ?? '') ?>"><br><br>

    <button type="submit"><?= $auteur ? "Modifier" : "Ajouter" ?></button>
</form>
</body>
</html>