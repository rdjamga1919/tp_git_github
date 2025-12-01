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
$age     = $_POST['age'];
$Filière = $_POST['filière'];
$moyenne = $_POST['moyenne'];

$sql = "UPDATE information SET nom=?, prenom=?, age=?, Filière=?, moyenne=? WHERE id=?";
$stmt = $bdd->prepare($sql);
$stmt->execute([$nom, $prenom, $age, $Filière, $moyenne, $id]);


header("Location: etudiant.php");
exit;
}


if (isset($_GET['id'])) {
$id = intval($_GET['id']);
$sql = "SELECT * FROM information WHERE id = ?";
$stmt = $bdd->prepare($sql);
$stmt->execute([$id]);
$etudiant = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modifier étudiant</title>
</head>
<body>
<h2>Modifier étudiant</h2>
<form method="post" action="modifier.php">
    <input type="hidden" name="id" value="<?php echo $etudiant['id']; ?>">

    Nom: <input type="text" name="nom" value="<?php echo $etudiant['nom']; ?>"><br>
    Prénom: <input type="text" name="prenom" value="<?php echo $etudiant['prenom']; ?>"><br>
    Âge: <input type="number" name="age" value="<?php echo $etudiant['age']; ?>"><br>
    Filière: <input type="text" name="filiere" value="<?php echo $etudiant['Filière']; ?>"><br>
    Moyenne: <input type="text" name="moyenne" value="<?php echo $etudiant['moyenne']; ?>"><br>

    <input type="submit" value="Enregistrer">
</form>
</body>
</html>