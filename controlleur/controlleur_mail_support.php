<?php
if(!isset($_SESSION)){
    session_start();
}

if($_SERVER["REQUEST_METHOD"] === "POST"){
    require_once(__DIR__ . "/lang.php");
    $lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'fr';
    $langData = getLangData($lang);

    if(isset($_POST["email"]) && $_POST["name"] && $_POST["subject"] && $_POST["message"]){
        $email = $_POST["email"];
        $name = $_POST["name"];
        $subject = $_POST["subject"];
        $message = $_POST["message"];


        // Validation de l'email
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            mail('edgar.mlrd@gmail.com', "Ticket : ".$subject, $message, "From: $name <$email>");
            echo "<script>alert('Votre message a été envoyé avec succès.');
            window.location.href = '../index.php';
            </script>";
            exit;

        }else{
            echo "<script>alert('Le format de l\'adresse email est invalide.');</script>";
        }
    }else{
        echo "<script>alert('Veuillez remplir tous les champs.');</script>";
    }
}