<?php

class Db {

    private $connexion;

    public function __construct($sqlite = 'esa.db'){
        $this->connexion = new PDO('sqlite:'.$sqlite);
    }

    public function findAll():array{
        $sql = "SELECT id,nom,prenom,email FROM users";
        $stmt = $this->connexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function store($data){
        $sql = "INSERT INTO users (nom, prenom, email) VALUES (?, ?, ?)";
        $stmt = $this->connexion->prepare($sql);
        $stmt->execute([$data['nom'], $data['prenom'], $data['email']]);
    }

}
