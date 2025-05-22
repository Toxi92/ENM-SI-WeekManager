<?php
require_once("../controlleur/controlleur_mail_support.php");
require_once(__DIR__ . "/../controlleur/controlleur_lang.php");
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'fr';
$langData = getLangData($lang);
// La fonction t() est déjà définie dans lang.php, inutile de la redéfinir ici
?>
<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($lang); ?>">
<head>
    <meta charset="UTF-8">
    <title><?php echo t('contactTitle', $langData); ?></title>
    <link  id='Style_theme' rel="stylesheet" href="../styles/style.css">
    <script src="../script/changeTheme.js"></script>
</head>

<header>
    <div class="DivAcceuil">
        <a class="BouttonAcceuil" href="../index.php"><p><?php echo t('home', $langData); ?></p></a>
    </div>
</header>

<body>
    <main>
        <h1><?php echo t('contactTitle', $langData); ?></h1>
        <p><?php echo t('contactIntro', $langData); ?></p>
        <p><a href="mailto:<?php echo t('contactMail', $langData); ?>"><?php echo t('contactMail', $langData); ?></a></p>
        <div class="DivContact">
            <form method="post" action="/../controlleur/controlleur_mail_support.php">
                <label for="email"><?php echo t('contactFormEmail', $langData); ?></label><br>
                <input type="email" id="email" name="email" required><br>
                <label for="name"><?php echo t('contactFormName', $langData); ?></label><br>
                <input type="text" id="name" name="name" required><br>
                <label for="subject"><?php echo t('contactFormSubject', $langData); ?></label><br>
                <input type="text" id="subject" name="subject" required><br>
                <label for="message"><?php echo t('contactFormMessage', $langData); ?></label><br>
                <textarea id="message" name="message" rows="5" required></textarea><br>
                <button type="submit"><?php echo t('contactFormSend', $langData); ?></button>
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