<?php

require_once "db.auth.php";
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

    }

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