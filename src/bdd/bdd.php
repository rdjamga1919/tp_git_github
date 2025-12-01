<?php
try{
    $pdo = new PDO('mysql:host=localhost;dbname=tp_git_github', 'root', '');
}catch(PDOException $e){
    $error = $e->getMessage();
    echo $error;
}