<?php
if(!isset($_SESSION)){
    session_start();
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once("../modele/db.auth.php");
    require_once(__DIR__ . "/controlleur_lang.php");
    $lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'fr';
    $langData = getLangData($lang);
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
        echo "<script>alert('".t('loginMailNotExist', $langData)."');</script>";
    } else {
        echo "<script>alert('".t('loginIncorrect', $langData)."');</script>";
    }
}