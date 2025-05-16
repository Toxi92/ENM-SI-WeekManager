<?php

require_once "db.auth.php";
require_once "db.edt.php";
require_once "db.php";
require_once(__DIR__."/../vendor/autoload.php");
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();
class Utilisateur {
    
    private string $username;
    private string $password;
    private string $email;
    private bool $admin;

    public function __construct(){
        $this->username = "";
        $this->password = "";
        $this->email = "";
        $this->admin = false;
        
    }

    public function login(string $username, string $password_user, string $email, bool $admin) {
        $this->username = $username;
        $this->password = $password_user;

        $this->email = $email;
        $this->admin = $admin;

        $host = $_ENV['HOST'];
        $db = $_ENV['DB'];
        $user = $_ENV['LOGIN'];
        $password = $_ENV['PASSWORD'];
        $bdd = new Database($host,"$db",$user,$password);
        $query2 = new QueryEDT($bdd);
        $query2->updateEDT($this->email);

    }
    // The $queryEDT variable is correctly used here because db.edt.php is included above,
    // which should define the QueryEDT class.
    public function getUsername(){
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function isAdmin(){
        return (bool) $this->admin;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setAdmin(bool $admin) {
        $this->admin = $admin;
    }

    public function setUsername(string $username) {
        $this->username = $username;
    }
    public function setPassword(string $password) {
        $this->password = $password;
    }
    public function setEmail(string $email) {
        $this->email = $email;
    }

    public function changePassword(string $newPassword) {
        $this->password = $newPassword;
    }

}