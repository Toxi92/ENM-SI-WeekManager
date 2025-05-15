<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once("../modele/db.auth.php");
    // Récupérer les données envoyées par le JavaScript
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (preg_match('/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}/im', $email)==false) {
        echo "<script>alert('Format d'adresse mail non valide.');</script>";
        exit;
    } 
    if ($query->isMailUsed($email)) {
        echo "<script>alert('L\'adresse e-mail est déjà utilisée.');</script>";
        exit;
    }
    $query->inscription($username,$password,$email);
    header('Location: ../vue/Connexion.php');
    exit;
};
?>