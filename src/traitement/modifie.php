<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=joe', 'joe', 'lovebooks');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id      = $_POST['id'];
    $nom     = $_POST['nom'];
    $prenom  = $_POST['prenom'];
    $datenaissance = $_POST['date de naissance'];
    $pays = $_POST['pays'];

    $sql = "UPDATE information SET nom=?, prenom=?, date_naissance, pays=? WHERE id=?";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$nom, $prenom, $age, $datenaissance, $pays]);


    header("Location: formmodification.html");
    exit;
}


if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM auteur WHERE id = ?";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$id]);
    $auteur = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modifier étudiant</title>
</head>
<body>
<h2>Modification auteur</h2>
<form method="post" action="modifier.php">
    <input type="hidden" name="id" value="<?php echo $auteur['id']; ?>">

    Nom: <input type="text" name="nom" value="<?php echo $auteur['nom']; ?>"><br>
    Prénom: <input type="text" name="prenom" value="<?php echo $auteur['prenom']; ?>"><br>
    Date de naissance: <input type="number" name="age" value="<?php echo $auteur['date de naissance']; ?>"><br>
    Pays: <input type="text" name="filiere" value="<?php echo $auteur['pays']; ?>"><br>


    <input type="submit" value="Enregistrer">
</form>
</body>
</html>