<?php
if(!isset($_SESSION)){
    session_start();
}

if($_SERVER["REQUEST_METHOD"] === "POST"){
    require_once(__DIR__ . "/controlleur_lang.php");
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
            echo "<script>alert('".t('contactMailSuccess', $langData)."');
            window.location.href = '../index.php';
            </script>";
            exit;
        }else{
            echo "<script>alert('".t('contactMailInvalid', $langData)."');</script>";
        }
    }else{
        echo "<script>alert('".t('contactMailFields', $langData)."');</script>";
    }
}