<?php

include_once("db.auth.php");
include_once("db.php");
include_once("db.user.php");
require_once(__DIR__."/../vendor/autoload.php");
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();
$host = $_ENV['HOST'];
$db = $_ENV['DB'];
$user = $_ENV['LOGIN'];
$password = $_ENV['PASSWORD'];
class QueryEDT{
    private $bdd;

    public function __construct(Database $bdd){
        $this->bdd = $bdd;
    }

    public function createEDT($email){
        if(date('D')!='Mon'){    
            $staticstart = date('Y-m-d',strtotime('last Monday'));    
        }else{
            $staticstart = date('Y-m-d');   
        }
        if(date('D')!='Sat'){
            $staticfinish = date('Y-m-d',strtotime('next Friday'));
        }else{
            $staticfinish = date('Y-m-d');
        }
        $req = $this->bdd->getConnexion()->prepare('INSERT INTO EDT (dateDeb,dateFin) VALUES (:dateDeb,:dateFin)');
        $req->execute(array(
            'dateDeb'=>$staticstart,
            'dateFin' => $staticfinish,
        ));
        $req1 = $this->bdd->getConnexion()->prepare('SELECT MAX(id) FROM EDT');
        $req1->execute();
        $result = $req1->fetch();
        $id = $result['MAX(id)'];
        $req2 = $this->bdd->getConnexion()->prepare('INSERT INTO Possède (email,id) VALUES (:email,:id)');
        $req2->execute(array(
            'email'=>$email,
            'id' => $id
        ));

    }
    public function updateEDT($email){
        if(date('D')!='Mon'){    
            $staticstart = date('Y-m-d',strtotime('last Monday'));    
        }else{
            $staticstart = date('Y-m-d');   
        }
        if(date('D')!='Sat'){
            $staticfinish = date('Y-m-d',strtotime('next Friday'));
        }else{
            $staticfinish = date('Y-m-d');
        }
        $req1 = $this->bdd->getConnexion()->prepare('SELECT id FROM Possède WHERE email = :email');
        $req1->execute(array(
            'email' => $email
        ));
        $result = $req1->fetch();
        $id = $result['id'];
        $req2 = $this->bdd->getConnexion()->prepare('UPDATE EDT SET dateDeb = :dateDeb, dateFin = :dateFin WHERE id = :id');
        $req2->execute(array(
            'dateDeb'=>$staticstart,
            'dateFin' => $staticfinish,
            'id' => $id
        ));}
    public function getSharedEDTs($email){
        $req = $this->bdd->getConnexion()->prepare('SELECT * FROM Possède WHERE email = :email AND rang != 3');
        $req->execute(array(
            'email' => $email
        ));
        $sharedEDTs = $req->fetchAll(PDO::FETCH_ASSOC);
        return $sharedEDTs;
    }
    public function deleteSharedEDT($email, $edtId){
        $req = $this->bdd->getConnexion()->prepare('DELETE FROM Possède WHERE email = :email AND id = :id');
        $req->execute(array(
            'email' => $email,
            'id' => $edtId
        ));
    }
    public function getEDTOwner($edtId){
        $req = $this->bdd->getConnexion()->prepare('SELECT email FROM Possède WHERE id = :id AND rang = 3');
        $req->execute(array(
            'id' => $edtId
        ));
        $result = $req->fetch();
        $email = $result['email'] ?? null; // Retourne l'email du propriétaire ou null si non trouvé
        $req2 = $this->bdd->getConnexion()->prepare('SELECT * FROM Utilisateurs WHERE email = :email');
        $req2->execute(array(
            'email' => $email
        ));
        $result2 = $req2->fetch();
        return $result2;
    }
    public function shareEDT($emailOwner,$emailDest,$rank){
        $req = $this->bdd->getConnexion()->prepare('SELECT id FROM Possède WHERE email = :emailOwner AND rang = 3');
        $req->execute(array(
            'emailOwner' => $emailOwner
        ));
        $result = $req->fetch();
        var_dump($result);
        $id= $result['id'];
        $req2 = $this->bdd->getConnexion()->prepare('INSERT INTO Possède (email, id, rang) VALUES (:emailDest, :id, :rank)');
        $req2->execute(array(
            'emailDest' => $emailDest,
            'id' => $id,
            'rank' => $rank
        ));
    }

    public function isShared($email, $edtId) {
        $req = $this->bdd->getConnexion()->prepare('SELECT * FROM Possède WHERE email = :email AND id = :id');
        $req->execute(array(
            'email' => $email,
            'id' => $edtId
        ));
        $result = $req->fetch(PDO::FETCH_ASSOC);
        return !empty($result); // Retourne true si l'emploi du temps est partagé avec l'email donné
    }
    public function getRank($email, $edtId) {
        $req = $this->bdd->getConnexion()->prepare('SELECT rang FROM Possède WHERE email = :email AND id = :id');
        $req->execute(array(
            'email' => $email,
            'id' => $edtId
        ));
        $result = $req->fetch(PDO::FETCH_ASSOC);
        return $result ? intval($result['rang']) : null; // Retourne le rang ou null si non trouvé
    }
    public function getListWhoHaveAccess($email) {
        $req = $this->bdd->getConnexion()->prepare('SELECT u.*,p.rang FROM Utilisateurs u JOIN Possède p ON u.email = p.email WHERE p.id = (SELECT id FROM Possède WHERE email = :email AND rang = 3)AND p.rang != 3');
        $req->execute(array(
            'email' => $email
        ));
        $result = $req->fetchAll(PDO::FETCH_ASSOC);
        return $result; // Retourne la liste des emails qui ont accès à l'emploi du temps
    }
    public function getOwnedEDTId($email) {
        $req = $this->bdd->getConnexion()->prepare(
            'SELECT id FROM Possède WHERE email = :email AND rang = 3'
        );
        $req->execute(['email' => $email]);
        $result = $req->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['id'] : null;
    }
    public function removeAccess($emailToRemove,$emailFromTo) {
    $req = $this->bdd->getConnexion()->prepare(
        'DELETE FROM Possède WHERE email = :email AND id = :id'
    );
    $req->execute(array(
        'email' => $emailToRemove,
        'id' => $this->getOwnedEDTId($emailFromTo)
        ));
    }
}
$bdd = new Database($host,$db,$user,$password);
$query2 = new QueryEDT($bdd);