<?php

include_once("../modele/db.user.php");
include_once("../modele/db.auth.php");
require_once(__DIR__ . "/controlleur_lang.php");
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'fr';
$langData = getLangData($lang);
if(!isset($_SESSION)){
    session_start();
}

if(
    $_SERVER['REQUEST_METHOD'] === 'POST' &&
    isset($_POST['new_password']) &&
    isset($_POST['current_password']) &&
    isset($_POST['email'])
) {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $email = $_POST['email'];
    if (password_verify($current_password, $query->getUserByEmail($email)['pwd']) == false) {
        echo '<script>
        alert("'.t('changePwdNotMatch', $langData).'");
        window.location.href = "../vue/Profile.php";
        </script>';
        exit;
    } else {
        $user = unserialize($_SESSION['user']);
        $email = $user->getEmail();
        $user->setPassword($new_password);
        $query->updateUserField($email, 'pwd', password_hash($new_password, PASSWORD_DEFAULT));
        $_SESSION['user'] = serialize($user);
        mail($email, t('changePwdMailSubject', $langData), t('changePwdMailBody', $langData));
        echo '<script>
        alert("'.t('changePwdSuccess', $langData).'");
        window.location.href = "../vue/Profile.php";
        </script>';
        exit;
    }
}

?>