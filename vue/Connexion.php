<?php 
require_once("../controlleur/controlleur_connexion.php");
require_once(__DIR__ . "/../controlleur/controlleur_lang.php");
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'fr';
$langData = getLangData($lang);
// La fonction t() est déjà définie dans lang.php
?>
<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($lang); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <title><?php echo t('loginTitle', $langData); ?></title>
</head>

<header>
    <div class="DivAcceuil">
        <a class="BouttonAcceuil" href="../index.php"><p><?php echo t('home', $langData); ?></p></a>
    </div>
</header>

<body>
    <div class="DivConnexion">
        <form action="Connexion.php" method="post">
            <label for="email"><?php echo t('loginEmail', $langData); ?></label>
            <input type="email" id="email" name="email" required>
            <label for="password"><?php echo t('loginPassword', $langData); ?></label>
            <input type="password" id="password" name="password" required>
            <input type="submit" value="<?php echo t('loginButton', $langData); ?>">
            <a class="BouttonInscription" href="./Inscription.php"><p><?php echo t('loginSignup', $langData); ?></p></a>
            <a class="BouttonMdpOublie" href="./MdpOublie.php"><?php echo t('loginForgot', $langData); ?></a>
        </form>
    </div>
</body>

<footer class="Footer">
    <div class="FooterButtons">
        <a href="./Contact.php" class="FooterButton"><?php echo t('footerContact', $langData); ?></a>
        <a href="./About.php" class="FooterButton"><?php echo t('footerAbout', $langData); ?></a>
        <a href="./Confidentialite.php" class="FooterButton"><?php echo t('footerConfidentialite', $langData); ?></a>
        <a href="./Aide.php" class="FooterButton"><?php echo t('footerAide', $langData); ?></a>
    </div>
</footer>
</html>