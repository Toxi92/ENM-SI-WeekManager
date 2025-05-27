<?php
session_start();
require_once(__DIR__ . '/../controlleur/controlleur_lang.php');
require_once(__DIR__ . '/../modele/db.edt.php');
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'fr';
$langData = getLangData($lang);

if (!isset($_SESSION['user'])) {
    header('Location: ../vue/Connexion.php');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $query2->removeAccess($_POST['emailToRemove'],$_POST['emailFromTo']);
    echo "<script>alert('" . t('sharedEDTRemoveSuccess', $langData) . $_POST['emailToRemove'] ."');</script>";
    echo "<script>window.location.href = '../vue/Profile.php';</script>";
}