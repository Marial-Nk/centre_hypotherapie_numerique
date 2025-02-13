<?php
require_once 'Db.php';

if(!empty($_POST['nom']) || !empty($_POST['prenom'])){
    $db = new Db();
    $db->store($_POST);    
    header('Location: index.php');   
    exit;
}
header('Location: create.php');


