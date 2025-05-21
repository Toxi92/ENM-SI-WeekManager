<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user'])) {
    echo '<script>
    alert("Vous devez être connecté pour accéder à cette page.");
    window.location.href = "../index.php";
    </script>';
    exit;
}
include_once(__DIR__ . "/../modele/db.task.php");
$user = unserialize($_SESSION['user']);

$task_id = $_GET['id'] ?? $_POST['task_id'] ?? null;
if (empty($query3->getTaskById($task_id))) {
    echo '<script>
    alert("Tâche introuvable.");
    window.location.href = "/../index.php";
    </script>';
    exit;
}
if($query3->isTaskOwnedByUser($task_id,$user->getEmail()) == false){
    echo '<script>
    alert("Vous n\'avez pas accès à cette tâche.");
    window.location.href = "/../index.php";
    </script>';
    exit;
}
$task = $task_id ? $query3->getTaskById($task_id) : null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['couleur'])) {
    $color = $_POST['couleur'];
    $query3->changeTaskColor($task['id'], $color);
    echo '<script>
    alert("La couleur de la tâche a été mise à jour avec succès !");
    window.location.href = "/../index.php";
    </script>';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $query3->deleteTask($_POST['task_id']);
    echo '<script>
    alert("La tâche a été supprimée avec succès !");
    window.location.href = "/../index.php";
    </script>';
    exit;
}