<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once(__DIR__ . "/controlleur_lang.php");
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'fr';
$langData = getLangData($lang);

if(isset($_GET['action']) && $_GET['action'] == 'reset') {
    if (!isset($_SESSION['user'])) {
        echo 
        '<script>
        alert("'.t('resetNotConnected', $langData).'");
        window.location.href = "../index.php";
        </script>';
        exit;
    }

    include_once(__DIR__."/../modele/db.user.php");
    include_once(__DIR__."/../modele/db.auth.php");
    include_once(__DIR__."/../modele/db.task.php");
    $user = unserialize($_SESSION['user']);
    try {
        $query3->deleteAllTasks($user->getEmail());
        echo '<script>
        alert("'.t('resetSuccess', $langData).'");
        window.location.href = "/../index.php";
        </script>';
    } catch (Exception $e) {
        echo '<script>
        alert("'.t('resetError', $langData).' ' . addslashes($e->getMessage()) . '");
        window.location.href = "/../index.php";
        </script>';
    }
    $_SESSION['user'] = serialize($user);
    exit;
}

?>