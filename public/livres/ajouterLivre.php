<?php
session_start();
require_once(__DIR__ . '/../../config.php');

//le if sert a demander si on a soumis le formulaire pour pouvoir l'inserer dans la bdd
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre = $_POST['titre'];
    $annee = $_POST['annee'];
    $resume = $_POST['resume'];
    $id_auteur = $_POST['id_auteur'];

    try {
        $sql = $pdo->prepare("INSERT INTO livre (titre,annee, resume) 
            VALUES (:titre, :annee, :resume)");
        $sql->execute([
            'titre' => $titre,
            'annee' => $annee,
            'resume' => $resume,
        ]); //pour inserer le livre dans bdd

        $id_livre =  $pdo->lastInsertId(); //recup le nouvel id du livre

        $stmt = $pdo->prepare("INSERT INTO ecrire (ref_livre, ref_auteur)
            VALUES (:ref_livre, :ref_auteur)");
        $stmt->execute([
            'ref_livre' => $id_livre,
            'ref_auteur' => $id_auteur,
        ]); // permet de lier le nouveau livre et l'auteur dans la table ecrire de la bdd

        header("location: listeLivre.php");
        exit();
    } catch (PDOException $e) {
        $erreur = "Erreur : " . $e->getMessage();
    }
}
$auteurs = $pdo->query("SELECT id_auteur, nom, prenom FROM auteur ORDER BY nom") //order by nom important pour esthetique,
//me permet de recup les auteurs meme ceux rajouter dans la bdd par la page de anais,

/*nb : -> permet d'acceder a qqch (a une methode = type de fontion defini a linterieur d'une classe. ou acceder a une propriete) sur un objet (ici $pdo mon objet)
exemple : $stmt (nom de variable statement qui va etre appeler par la suite) = $pdo (objet défini dans bdd.php) -> (appelle la methode prepare) prepare (methode php qui prend une requetes sql avec des paramettres (ici etiquettes :titre...) et renvoi un autre objet)
syntaxe generale :
$objet->methode();
$objet->propriete;
*/

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

        <?php if (isset($erreur)): ?>
            <div class="alert alert-danger"><?= $erreur ?></div>
        <?php endif; ?> <! permet affichage derreur avec le catch!>

        <form method="POST" action="ajouterLivre.php">
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