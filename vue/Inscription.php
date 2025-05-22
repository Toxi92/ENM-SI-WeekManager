<?php
require_once("../controlleur/controlleur_inscription.php");
require_once(__DIR__ . "/../controlleur/controlleur_lang.php");
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'fr';
$langData = getLangData($lang);

?>
<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($lang); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link  id='Style_theme' rel="stylesheet" href="../styles/style.css">
    <script src="../script/changeTheme.js"></script>
    <title><?php echo t('registerTitle', $langData); ?></title>
</head>
<header>
    <div class="DivAcceuil">
        <a class="BouttonAcceuil" href="../index.php"><p><?php echo t('home', $langData); ?></p></a>
    </div>
</header>
<body>
    <main>
    <div class="DivConnexion">
        <form action="Inscription.php" method="post" id="formulaire_inscription">
            <label for="username"><?php echo t('registerName', $langData); ?></label>
            <input type="text" id="username" name="username" required>
            <label for="email"><?php echo t('registerEmail', $langData); ?></label>
            <input type="email" id="email" name="email" required>
            <label for="password"><?php echo t('registerPassword', $langData); ?></label>
            <input type="password" id="password" name="password" required>
            <label for="passwordconfirm"><?php echo t('registerPasswordConfirm', $langData); ?></label>
            <input type="password" id="passwordconfirm" name="passwordconfirm" required>
            <input type="submit" value="<?php echo t('registerButton', $langData); ?>">
            <a class="BouttonInscription" href="./Connexion.php"><p><?php echo t('registerAlready', $langData); ?></p></a>
        </form>
    </div>
    </main>
</body>
<footer class="Footer">
    <div class="FooterButtons">
        <a href="./Contact.php" class="FooterButton"><?php echo t('footerContact', $langData); ?></a>
        <a href="./About.php" class="FooterButton"><?php echo t('footerAbout', $langData); ?></a>
        <a href="./Confidentialite.php" class="FooterButton"><?php echo t('footerConfidentialite', $langData); ?></a>
        <a href="./Aide.php" class="FooterButton"><?php echo t('footerAide', $langData); ?></a>
        <div class="LangSelector" style="position:absolute;top:10px;right:10px;">
            <form method="post" action="">
                <button type="submit" name="lang" value="fr" style="background:none;border:none;padding:0;cursor:pointer;">
                    <img src="/../images/fr.png" alt="Français" width="32" height="20">
                </button>
                <button type="submit" name="lang" value="en" style="background:none;border:none;padding:0;cursor:pointer;">
                    <img src="/../images/en.png" alt="English" width="32" height="20">
                </button>
            </form>
        </div>
    </div>
</footer>
</html>