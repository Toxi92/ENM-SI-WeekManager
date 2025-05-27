<?php
// Contrôleur pour gérer le partage d'emploi du temps
session_start();
require_once(__DIR__ . '/../modele/db.user.php');
require_once(__DIR__ . '/../modele/db.php');
require_once(__DIR__ . '/../controlleur/controlleur_lang.php');
require_once(__DIR__ . '/../modele/db.auth.php');
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'fr';
$langData = getLangData($lang);
$user = unserialize($_SESSION['user']);
if (!isset($_SESSION['user'])) {
    header('Location: ../vue/Connexion.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dest = $_POST['share_email'];
    $rank = intval($_POST['share_rank']);
    $user = unserialize($_SESSION['user']);
    if ($dest === $user->getEmail()) {
        echo "<script>alert('" . t('sharedEDTInvalidSelfShare', $langData) . "');</script>";
        exit;
    }
    if ($query->isMailUsed($dest)==false) {
        echo '<script>alert("' . t('sharedEDTInvalidEmail', $langData) . '");
        window.location.href = "../vue/Profile.php";</script>';
        exit;
    }
 
    $query2->shareEDT($user->getEmail(), $dest, intval($rank));
    echo "<script>alert('" . t('sharedEDTSuccess', $langData). $dest . "');
    window.location.href = '../vue/Profile.php';</script>";


}
