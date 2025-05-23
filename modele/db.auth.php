<?php

include_once("db.php");
include_once("db.user.php");
include_once("db.edt.php");
require_once(__DIR__."/../vendor/autoload.php");
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();

$host = $_ENV['HOST'];
$db = $_ENV['DB'];
$user = $_ENV['LOGIN'];
$password = $_ENV['PASSWORD'];

class QueryUser{
    private $bdd;

    public function __construct(Database $bdd){
        $this->bdd = $bdd;
    }
    public function inscription($username,$password,$email){
        $req = $this->bdd->getConnexion()->prepare('INSERT INTO Utilisateurs (email,pwd,username,admin) VALUES (:email,:pwd,:username,0)');
        $req->execute(array(
            'email'=>$email,
            'username' => $username,
            'pwd' => password_hash($password,PASSWORD_DEFAULT),
        ));
        $bdd = new Database("mysql-molard.alwaysdata.net","molard_enm-week-manager","molard","kbbULD53-!");
        $query2 = new QueryEDT($bdd);
        $query2->createEDT($email);
    }

    public function getUserByEmail($email){
        $req = $this->bdd->getConnexion()->prepare("SELECT * FROM Utilisateurs WHERE email = :email");
        $req->execute(array(
            'email' => $email
        ));
        $result = $req->fetch();
        if(empty($result)){
            return false;
        }else{
            return $result;
        }
    }

    public function isMailUsed($email){
        $req = $this->bdd->getConnexion()->prepare("SELECT * FROM Utilisateurs WHERE email = :email");
        $req->execute(array(
            'email' => $email
        ));
        $result = $req->fetch();
        if(empty($result)){
            return false;
        }else{
            return true;
        }
    }
    public function setAdmin($email){
        $req = $this->bdd->getConnexion()->prepare("UPDATE Utilisateurs SET Admin = 1 WHERE email = :email");
        $req->execute(array(
            'email' => $email
        ));
    }
    public function setUser($email){
        $req = $this->bdd->getConnexion()->prepare("UPDATE Utilisateurs SET Admin = 0 WHERE email = :email");
        $req->execute(array(
            'email' => $email
        ));
    }
    public function updateUserField($userEmail, $field, $value) {
        $allowedFields = ['email', 'pwd', 'username'];
        if (in_array($field, $allowedFields)) {
            $sql = "UPDATE Utilisateurs SET $field = :value WHERE email = :email";
            $stmt = $this->bdd->getConnexion()->prepare($sql);
            return $stmt->execute([
                'value' => $value,
                'email' => $userEmail
            ]);
        }
        return false;
    }

    public function ISa2fON($email){
        $req = $this->bdd->getConnexion()->prepare("SELECT * FROM Utilisateurs WHERE email = :email");
        $req->execute(array(
            'email' => $email
        ));
        $result = $req->fetch();
        if($result['a2f'] == 1){
            return true;
        }else{
            return false;
        }
    }

    public function setA2f($email){
        $req = $this->bdd->getConnexion()->prepare("UPDATE Utilisateurs SET a2f = 1 WHERE email = :email");
        $req->execute(array(
            'email' => $email
        ));
    }
    public function unsetA2f($email){
        $req = $this->bdd->getConnexion()->prepare("UPDATE Utilisateurs SET a2f = 0 WHERE email = :email");
        $req->execute(array(
            'email' => $email
        ));
    }

    public function getSecret($email){
        $req = $this->bdd->getConnexion()->prepare("SELECT * FROM Utilisateurs WHERE email = :email");
        $req->execute(array(
            'email' => $email
        ));
        $result = $req->fetch();
        return $result['a2f_secret'];
    }

    public function setSecret($email,$secret){
        $req = $this->bdd->getConnexion()->prepare("UPDATE Utilisateurs SET a2f_secret = :secre where email = :email");
        $req->execute(array(
            'email' => $email,
            'secre' => $secret
        ));
    }
}

$bdd = new Database($host,"$db",$user,$password);
$query = new QueryUser($bdd);
$user = new Utilisateur();
