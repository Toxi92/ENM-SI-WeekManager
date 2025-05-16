<?php

include_once("../modele/db.user.php");
include_once("../modele/db.auth.php");
session_start();

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_password']) && isset($_POST['current_password']) && isset($_POST['email'])) {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $email = $_POST['email'];
    if (password_verify($current_password, $query->getUserByEmail($email)['pwd']) == false) {
        echo '<script>
        alert("Les mots de passe ne correspondent pas !");
        window.location.href = "../vue/Profile.php";
        </script>';
        exit;
    }else{
        $user = unserialize($_SESSION['user']);
        $email = $user->getEmail();
        $user->setPassword($new_password);
        $query->updateUserField($email, 'pwd', password_hash($new_password,PASSWORD_DEFAULT));
        $_SESSION['user'] = serialize($user);
        mail($email, "Changement de mot de passe", "Votre mot de passe a été changé avec succès via les paramètres de profil.");
        echo '<script>
        alert("Mot de passe changé avec succès !");
        window.location.href = "../vue/Profile.php";
        </script>';
        exit;
    }

}

?>