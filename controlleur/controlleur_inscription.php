<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once("../modele/db.auth.php");
    // Récupérer les données envoyées par le JavaScript
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    if ($query->isMailUsed($email)) {
        echo "<script>alert('L\'adresse e-mail est déjà utilisée.');</script>";
        exit;
    }
    $query->inscription($username,$password,$email);
    echo error_log(E_ALL);
    header('Location: ../vue/Connexion.php');
    echo alert("Inscription réussie ! Vous pouvez maintenant vous connecter.");
};
?>
