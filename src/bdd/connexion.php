<?php
try{
$bdd = new PDO('mysql:host=localhost;dbname=joe', 'joe',  'lovebooks');
}catch(PDOException $e){
    echo"Erreur:".$e->getMessage();
}