<?php
try{
    $pdo = new PDO('mysql:host=localhost;dbname=tp_git_github', 'joe', 'lovebooks');
}catch(PDOException $e){
    $error = $e->getMessage();
    echo $error;
}