<?php
if(!isset($_SESSION)){
    session_start();
}

require_once(__DIR__ . "/../controlleur/controlleur_lang.php");
require_once(__DIR__ . "/../controlleur/controlleur_activation_a2f.php");
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'fr';
$langData = getLangData($lang);
?>

<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <title>ENM WEEK MANAGER</title>
    <link rel="icon" type="image/x-icon" href="../favicon.ico">
    <link id="Style_theme" rel="stylesheet" href="../styles/style.css">
    <script src="../script/changeTheme.js"></script>
</head>
<header>
    <a class="BouttonAcceuilProfil" href="../index.php"><p><?php echo t('profileHome', $langData); ?></p></a>
</header>
<body>
    <main>
        
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