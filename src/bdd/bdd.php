<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=joe;charset=utf8', 'joe', 'lovebooks');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}