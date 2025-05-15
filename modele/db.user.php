<?php

require_once "db.auth.php";
require_once "db.edt.php";
require_once "db.php";
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

    public function login(string $username, string $password, string $email, bool $admin) {
        $this->username = $username;
        $this->password = $password;

        $this->email = $email;
        $this->admin = $admin;
        $bdd = new Database("mysql-molard.alwaysdata.net","molard_enm-week-manager","molard","kbbULD53-!");
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

}