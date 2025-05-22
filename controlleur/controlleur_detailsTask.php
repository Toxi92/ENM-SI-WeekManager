<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once(__DIR__ . "/controlleur_lang.php");
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'fr';
$langData = getLangData($lang);

if (!isset($_SESSION['user'])) {
    echo '<script>
    alert("'.t('taskNotConnected', $langData).'");
    window.location.href = "../index.php";
    </script>';
    exit;
}
include_once(__DIR__ . "/../modele/db.task.php");
$user = unserialize($_SESSION['user']);

$task_id = $_GET['id'] ?? $_POST['task_id'] ?? null;
if (empty($query3->getTaskById($task_id))) {
    echo '<script>
    alert("'.t('taskNotFound', $langData).'");
    window.location.href = "/../index.php";
    </script>';
    exit;
}
if($query3->isTaskOwnedByUser($task_id,$user->getEmail()) == false){
    echo '<script>
    alert("'.t('taskNoAccess', $langData).'");
    window.location.href = "/../index.php";
    </script>';
    exit;
}
$task = $task_id ? $query3->getTaskById($task_id) : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['couleur'])) {
    $color = $_POST['couleur'];
    $query3->changeTaskColor($task['id'], $color);
    echo '<script>
    alert("'.t('taskColorSuccess', $langData).'");
    window.location.href = "/../index.php";
    </script>';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $query3->deleteTask($_POST['task_id']);
    echo '<script>
    alert("'.t('taskDeleteSuccess', $langData).'");
    window.location.href = "/../index.php";
    </script>';
    exit;
}
?>