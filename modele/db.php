<?php

class DataBase{
    private string $host;
    private string $db;
    private string $login;
    private string $password;

    private PDO $connexion;

    public function __construct(string $host, string $db, string $login, string $password){
        $this->host = $host;
        $this->db = $db;
        $this->login = $login;
        $this->password = $password;
        try{
            $this->connexion = new PDO("mysql:host=$host;dbname=$db", $login, $password);
            $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            echo "Erreur : " . $e->getMessage();
            die();
        }


    }

    public function getConnexion(){
        return $this->connexion;
    }
}