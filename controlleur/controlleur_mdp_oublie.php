<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    mail($email, "Réinitialisation de mot de passe", "Cliquez sur le lien pour réinitialiser votre mot de passe : http://example.com/reset.php?email=$email");
}