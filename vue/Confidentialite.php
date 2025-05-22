<?php 
require_once(__DIR__ . "/lang.php");
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'fr';
$langData = getLangData($lang); 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Confidentialité</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>

<header>
<div class="DivAcceuil">
        <a class="BouttonAcceuil" href="../index.php"><p>Accueil</p></a>
    </div>
</header>

<body>
    <h1>Politique de confidentialité</h1>
    <p>Nous respectons votre vie privée. Les données collectées sont utilisées uniquement pour le bon fonctionnement du service et ne sont jamais partagées avec des tiers sans votre consentement.</p>
    <p>Pour toute question concernant la confidentialité, veuillez nous contacter.</p>
</body>

<footer class="Footer">
    <div class="FooterButtons">
        <a href="./Contact.php" class="FooterButton">Contact</a>
        <a href="./About.php" class="FooterButton">À propos</a>
        <a href="./Confidentialite.php" class="FooterButton">Confidentialité</a>
        <a href="./Aide.php" class="FooterButton">Aide</a>
    </div>
</footer>

</html>