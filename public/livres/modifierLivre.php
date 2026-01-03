<?php
session_start();
require_once(__DIR__ . '/../../config.php');

if (!isset($_GET['id'])) {
    header('location: listeLivre.php');
    exit();
}
$id_livre = $_GET['id'];

$sql = $pdo->prepare("SELECT l.*, e.ref_auteur 
                       FROM livre l 
                       JOIN ecrire e ON l.id_livre = e.ref_livre 
                       WHERE l.id_livre = :id");
$sql->execute(['id' => $id_livre]);
$livre = $sql->fetch(PDO::FETCH_ASSOC);
if (!$livre) {
    header('location: listeLivre.php');
    exit();
} // permet de preremplir le formulaire de modif du livre avec les  données de la bdd

$auteurs = $pdo->query("SELECT id_auteur, nom, prenom FROM auteur ORDER BY nom")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un livre</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Modifier le livre</h1>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger">
            Une erruer est survenue lors de la modification du livre.
        </div>
    <?php endif; ?>

    <form method="POST" action="../../src/traitement/livres/modifier.php">
        <input type="hidden" name="id_livre" value="<?= htmlspecialchars($livre['id_livre']) ?>">

        <div class="mb-3">
            <label for="titre" class="form-label">Titre :</label>
            <input type="text" class="form-control" id="titre" name="titre"
                   value="<?= htmlspecialchars($livre['titre']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="annee" class="form-label">Année :</label>
            <input type="text" class="form-control" id="annee" name="annee"
                   maxlength="4" value="<?= htmlspecialchars($livre['annee']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="id_auteur" class="form-label">Auteur :</label>
            <select class="form-control" id="id_auteur" name="id_auteur" required>
                <option value="">-- Choisir un auteur --</option>
                <?php foreach ($auteurs as $auteur): ?>
                    <option value="<?= $auteur['id_auteur'] ?>"
                        <?= ($auteur['id_auteur'] == $livre['ref_auteur']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($auteur['nom'] . ' ' . $auteur['prenom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="resume" class="form-label">Résumé :</label>
            <textarea class="form-control" id="resume" name="resume" rows="4"><?= htmlspecialchars($livre['resume'] ?? '') ?></textarea>
        </div>

        <button type="submit" class="btn btn-warning">Modifier</button>
        <a href="listeLivre.php" class="btn btn-secondary">Annuler</a>
    </form>
</div>
</body>
</html>