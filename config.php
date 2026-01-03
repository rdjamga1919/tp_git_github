<?php
// tp_git_github/config.php
const ROOT = __DIR__ ;
//define('ROOT', __DIR__); > ancienne maniere de definir une constante sur PHP

// Connexion à la BDD + retourner $pdo afin de la reutiliser dans mes pages livres
require_once(ROOT . '/src/bdd/bdd.php');
//page pour universaliser l'acces a la bdd sur mamp et wamp
//fichier config est important car il me permet de lier toute mes pages a la bdd sans devoir changer le chemin vers bdd.php dans chaque page