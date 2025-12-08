<?php
try{
    $pdo = new PDO('mysql:host=localhost;dbname=joe', 'joe', 'lovebooks');
}catch(PDOException $e){
    $error = $e->getMessage();
    echo $error;
}