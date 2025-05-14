<?php
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once("../modele/db.auth.php");
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($query->getUserByEmail($email)!=false && password_verify($password, $query->getUserByEmail($email)['pwd'])) {
        session_start();
        $res=$query->getUserByEmail($email);
        $user->login($res['username'], $res['pwd'], $res['email'], $res['admin']);
        $_SESSION['user'] = serialize($user);
        header('Location: ../index.php');
        exit;
    } elseif ($query->getUserByEmail($email)==false) {
        echo "<script>alert('L\'adresse e-mail n\'existe pas.');</script>";
    } else {
        echo "<script>alert('Identifiants incorrects.');</script>";
    }
}