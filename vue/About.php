<?php 
require_once(__DIR__ . "/lang.php");
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'fr';
$langData = getLangData($lang); 
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>À propos</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>

<header>
    <div class="DivAcceuil">
        <a class="BouttonAcceuil" href="../index.php"><p>Accueil</p></a>
    </div>
</header>

<body>
    <h1>À propos</h1>
    <p>Ce site a été développé pour faciliter la gestion et le partage des emplois du temps au sein de l'ENM.</p>
    <p>Version : 1.0</p>
    <p>Développé par Edgar Molard lors de son passage dans le SIAV de l'ENM Paris.</p>
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