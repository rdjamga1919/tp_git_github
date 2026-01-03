<?php
session_start();
require_once(__DIR__ . '/../../config.php');

$auteurs = $pdo->query("SELECT id_auteur, nom, prenom FROM auteur ORDER BY nom") //order by nom important pour esthetique,
//me permet de recup les auteurs meme ceux rajouter dans la bdd par la page de anais,

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un livre</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Ajouter un nouveau livre</h1>

        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger">
                Une erreur est survenue lors de l’ajout du livre.
            </div>
        <?php endif; ?> <! permet affichage derreur avec le catch du ajoute.php dans traitement!>

        <form method="POST" action="../../src/traitement/livres/ajouter.php">
            <div class="mb-3">
                <label for="titre" class="form-label">Titre :</label>
                <input type="text" class="form-control" id="titre" name="titre" required>
            </div>

            <div class="mb-3">
                <label for="annee" class="form-label">Année :</label>
                <input type="text" class="form-control" id="annee" name="annee" maxlength="4" required>
            </div>

            <div class="mb-3">
                <label for="id_auteur" class="form-label">Auteur :</label>
                <select class="form-control" id="id_auteur" name="id_auteur" required>
                    <option value="">-- Choisir un auteur --</option>
                    <?php foreach ($auteurs as $auteur): ?>
                        <option value="<?= $auteur['id_auteur'] ?>">
                            <?= htmlspecialchars($auteur['nom'] . ' ' . $auteur['prenom']) ?>
                        </option>
                    <?php endforeach; ?> <! avoir si je lie ca a la page ajouter auteur d'anais au cas ou auteurs existe pas!>
                </select>
            </div>
            <! a href="src/traitement/auteurs/ajouter.php" class="btn btn-success" Ajouter un auteur impossible  car pas de page auteur public !>

            <div class="mb-3">
                <label for="resume" class="form-label">Résumé :</label>
                <textarea class="form-control" id="resume" name="resume" rows="4"></textarea>
            </div>

            <button type="submit" class="btn btn-success">Ajouter</button>
            <a href="listeLivre.php" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</body>
</html>