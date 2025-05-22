<?php 
require_once(__DIR__ . "/lang.php");
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'fr';
$langData = getLangData($lang); 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>404 - Page non trouvée</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
    <div class="notfound-container">
        <div class="notfound-title">404</div>
        <div class="notfound-message">Oups ! La page demandée n'existe pas.</div>
        <a class="notfound-link" href="../index.php">Retour à l'accueil</a>
    </div>
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