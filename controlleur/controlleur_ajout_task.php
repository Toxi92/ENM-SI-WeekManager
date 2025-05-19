<?php

if(!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['user'])) {
    echo 
    '<script>
    alert("Vous devez être connecté pour accéder à cette page.");
    window.location.href = "../index.php";
    </script>';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once("../modele/db.user.php");
    include_once("../modele/db.auth.php");
    include_once("../modele/db.task.php");


    $user = unserialize($_SESSION['user']);

    try {
        $query3->createTask($user->getEmail(), $_POST['title'], $_POST['description'], $_POST['jour'],$_POST['heure_debut'], $_POST['heure_fin']);
        echo '<script>
        alert("Tâche créée avec succès !");
        window.location.href = "/../../index.php";
        </script>';
    } catch (Exception $e) {
        echo '<script>
        alert("Erreur lors de la création de la tâche : ' . $e->getMessage() . '");
        window.location.href = "../vue/Task.php";
        </script>';
    }

    $_SESSION['user'] = serialize($user);
}