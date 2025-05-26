<?php

if(!isset($_SESSION)){
    session_start();
}

require_once(__DIR__ . "/controlleur_lang.php");

$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'fr';
$langData = getLangData($lang);

if(!isset($_SESSION['user'])) {
    echo "<script>alert('".t('loginRequired', $langData)."'); 
    window.location.href = '../vue/Connexion.php';
    </script>";
    exit;
}
require_once(__DIR__."/../modele/db.auth.php");
require_once(__DIR__ . "/../modele/db.user.php");
$user = unserialize($_SESSION['user']);
$query->unsetA2f($user->getEmail());
$query->delSecret($user->getEmail());

echo '<script>
alert("'.t('a2fDesactivated', $langData).'"); 
window.location.href = "../vue/Profile.php";
</script>';
exit;
