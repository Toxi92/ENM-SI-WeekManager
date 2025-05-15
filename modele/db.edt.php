<?php

include_once("db.auth.php");
include_once("db.php");
include_once("db.user.php");

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
}
$bdd = new Database("mysql-molard.alwaysdata.net","molard_enm-week-manager","molard","kbbULD53-!");
$query2 = new QueryEDT($bdd);