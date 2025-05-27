<?php

if(!isset($_SESSION)) {
    session_start();
}

require_once(__DIR__ . "/controlleur_lang.php");
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'fr';
$langData = getLangData($lang);

if (!isset($_SESSION['user'])) {
    echo 
    '<script>
    alert("'.t('taskNotConnected', $langData).'");
    window.location.href = "../index.php";
    </script>';
    exit;
}
include_once("../modele/db.edt.php");

if($query2->isShared($_GET['edt_owner_email'],$_GET['edt_id'])!=true) {
    echo "<script>alert('".t('sharedEDTNotShared', $langData)."');
    window.location.href = '../index.php';
    </script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once("../modele/db.user.php");
    include_once("../modele/db.auth.php");
    include_once("../modele/db.task.php");

    $user = unserialize($_SESSION['user']);
    if (!isset($_POST['title']) || !isset($_POST['description']) || !isset($_POST['jour']) || !isset($_POST['heure_debut']) || !isset($_POST['heure_fin'])) {
        echo '<script>
        alert("'.t('taskFieldsRequired', $langData).'");
        window.location.href = "../vue/Task.php";
        </script>';
        exit;
    }
    if ($_POST['heure_debut'] > $_POST['heure_fin']) {
        echo '<script>
        alert("'.t('taskStartBeforeEnd', $langData).'");
        window.location.href = "../vue/Task.php";
        </script>';
        exit;
    }
    try {
        $query3->createTask($_GET['edt_owner_email'], $_POST['title'], $_POST['description'], $_POST['jour'],$_POST['heure_debut'], $_POST['heure_fin']);
        echo '<script>
        alert("'.t('taskCreateSuccess', $langData).'");
        window.location.href = "/../../index.php";
        </script>';
    } catch (Exception $e) {
        echo '<script>
        alert("'.t('taskCreateError', $langData).' ' . addslashes($e->getMessage()) . '");
        window.location.href = "../vue/Task.php";
        </script>';
    }

    $_SESSION['user'] = serialize($user);
}