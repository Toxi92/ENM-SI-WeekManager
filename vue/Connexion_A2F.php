<?php
session_start();
require_once (__DIR__.'/../controlleur/controlleur_lang.php'); // Inclusion du système de traduction
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'fr';
$langData = getLangData($lang);
require_once (__DIR__.'/../controlleur/controlleur_connexion_a2f.php'); // Inclusion du contrôleur de connexion A2F
?>
<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title><?php echo t('connexion.a2f.title',$langData); ?></title>
    <link id="Style_theme" rel="stylesheet" href="../styles/style.css">
    <script src="../script/changeTheme.js"></script>
</head>

<body><main>
    <div class="a2f-container">
        <h2><?php echo t('connexion.a2f.heading',$langData); ?></h2>
        <form method="POST" action="../controlleur/controlleur_connexion_a2f.php">
            <label for="a2f_code"><?php echo t('connexion.a2f.label_code',$langData); ?></label><br>
            <input type="text" id="a2f_code" name="a2f_code" maxlength="6" required autocomplete="one-time-code"><br>
            <button type="submit"><?php echo t('connexion.a2f.submit',$langData); ?></button>
        </form>
        <?php
        if (isset($_SESSION['a2f_error'])) {
            echo '<div class="a2f-error">' . htmlspecialchars($_SESSION['a2f_error']) . '</div>';
            unset($_SESSION['a2f_error']);
        }
        ?>
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