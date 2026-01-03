<?php

/*session_start();

echo "<h1>TEST DE CONNEXION</h1>";

echo "<p>Étape 1: Avant require_once</p>";

require_once(__DIR__ . '/../../config.php');

echo "<p>Étape 2: Après require_once</p>";

echo "<p>Variable \$pdo existe? " . (isset($pdo) ? 'OUI' : 'NON') . "</p>";

if (isset($pdo)) {
    echo "<p>Type: " . get_class($pdo) . "</p>";
    echo "<p>✅ CONNEXION OK!</p>";
} else {
    echo "<p>❌ \$pdo n'existe pas</p>";
    echo "<p>Variables disponibles:</p>";
    echo "<pre>";
    print_r(get_defined_vars());
    echo "</pre>";
}

die('FIN DU TEST');

/*echo "<pre>";
echo "Chemin actuel: " . __DIR__ . "\n";
echo "Chemin config.php: " . __DIR__ . '/../../config.php' . "\n";
echo "Fichier existe? " . (file_exists(__DIR__ . '/../../config.php') ? 'OUI' : 'NON') . "\n";
echo "</pre>";*/

session_start(); // accessible seulement si user est connecté !!!

require_once(__DIR__ . '/../../config.php');


// la je selection avec sql tous les livres avec leurs auteurs dans la bdd
//nb : <?= c'est pareil que <?php echo servent a afficher variable dans html juste plus court par contre c'est seulement en echo et ne prend pas de conditions...
$sql = "SELECT 
            l.id_livre,
            l.titre,
            l.annee,
            a.nom,
            a.prenom
        FROM livre l
        JOIN ecrire e ON l.id_livre = e.ref_livre
        JOIN auteur a ON e.ref_auteur = a.id_auteur
        ORDER BY l.titre";
// il faut "activer" le languages sql pour pouvoir faire ca dans languages et framework, reverifier la methode d'anais et du prof

$stmt = $pdo->query($sql);
$livres = $stmt->fetchAll(PDO::FETCH_ASSOC); // fetch important car renvoi un tableau associatif avec colonnes de la bdd
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des livres</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Liste des Livres</h1>

        <a href="ajouterLivre.php" class="btn btn-success mb-3">Ajouter un livre</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Année</th>
                    <th>Auteur</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($livres as $livre): ?>
                <tr>
                    <td><?= htmlspecialchars($livre['titre']) ?></td>
                    <td><?= htmlspecialchars($livre['annee']) ?></td>
                    <td><?= htmlspecialchars($livre['nom'] . ' ' . $livre['prenom']) ?></td>
                    <td>
                        <form action="../../src/traitement/livres/supprimer.php" method="POST">
                            <input type="hidden" name="id_livre" value="<?= htmlspecialchars($livre['id_livre']) ?>"> <!le htmlspecialchars ($livre[id_livre) permet de preciser quel livre suppirmer de la bdd par son id de maniere + securisé!>
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce livre ?')">Supprimer</button> <!"onclick" js pour le bouton de confirmation, tester sans pour voir si pas trop brutal!>
                        </form>

                        <a href="modifierLivre.php?id=<?= $livre['id_livre'] ?>" class="btn btn-warning btn-sm">Modifier</a>

                    </td>

                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<!bien verfier la page liste etudiant de mme messani!>