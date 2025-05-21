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

class QueryTask{
    private $bdd;

    public function __construct(Database $bdd){
        $this->bdd = $bdd;
    }

    public function getEDTidByEmail($email){
        $req = $this->bdd->getConnexion()->prepare('SELECT id FROM Possède WHERE email = :email');
        $req->execute(array(
            'email'=>$email
        ));
        $result = $req->fetch(PDO::FETCH_ASSOC);
        if($result){
            $id = $result['id'];
            return $id;
        }else{
            return null;
        }
    }


    public function getTasksByEmail($email){
        $req = $this->bdd->getConnexion()->prepare('SELECT * FROM Taches WHERE id_1 = :id_1');
        $req->execute(array(
            'id_1'=>$this->getEDTidByEmail($email)
        ));
        $result = $req->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function createTask($email, $title, $description, $jour, $heureDeb, $heureFin) {
        $edtId = $this->getEDTidByEmail($email);

        // Vérifier le chevauchement
        $req = $this->bdd->getConnexion()->prepare(
            'SELECT * FROM Taches 
            WHERE id_1 = :id_1 
            AND Jour = :jour
            AND (
                (:heureDeb < DateHeureFin AND :heureFin > DateHeureDeb)
            )'
        );
        $req->execute([
            'id_1' => $edtId,
            'jour' => $jour,
            'heureDeb' => $heureDeb,
            'heureFin' => $heureFin
        ]);
        $result = $req->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            // Chevauchement détecté
            throw new Exception("Une tâche existe déjà sur ce créneau.");
        }

        // Si pas de chevauchement, on insère la tâche
        $req = $this->bdd->getConnexion()->prepare(
            'INSERT INTO Taches (Nom, Description, Jour, DateHeureDeb, DateHeureFin, id_1) 
            VALUES (:Nom, :Description, :Jour, :DateHeureDeb, :DateHeureFin, :id_1)'
        );
        $req->execute([
            'Nom' => $title,
            'Description' => $description,
            'Jour' => $jour,
            'DateHeureDeb' => $heureDeb,
            'DateHeureFin' => $heureFin,
            'id_1' => $edtId
        ]);
    }

    public function deleteTask($id){
        $req = $this->bdd->getConnexion()->prepare('DELETE FROM Taches WHERE id = :id');
        $req->execute(array(
            'id'=>$id
        ));
    }

    public function deleteAllTasks($email){
        $req = $this->bdd->getConnexion()->prepare('DELETE FROM Taches WHERE id_1 = :id_1');
        $req->execute(array(
            'id_1'=>$this->getEDTidByEmail($email)
        ));
    }
    public function getTaskById($id){
        $req = $this->bdd->getConnexion()->prepare('SELECT * FROM Taches WHERE id = :id');
        $req->execute(array(
            'id'=>$id
        ));
        $result = $req->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function changeTaskColor($id, $color){
        $req = $this->bdd->getConnexion()->prepare('UPDATE Taches SET Couleur = :Couleur WHERE id = :id');
        $req->execute(array(
            'Couleur'=>$color,
            'id'=>$id
        ));
    }
    public function isTaskOwnedByUser($taskId, $email){
        $req = $this->bdd->getConnexion()->prepare('SELECT * FROM Taches WHERE id = :id AND id_1 = :id_1');
        $req->execute(array(
            'id'=>$taskId,
            'id_1'=>$this->getEDTidByEmail($email)
        ));
        $result = $req->fetch(PDO::FETCH_ASSOC);
        return !empty($result);
    }
}
 
$query3 = new QueryTask($bdd);

?>