<?php
require_once("../controlleur/controlleur_mdp_oublie.php"); 
require_once(__DIR__ . "/../controlleur/controlleur_lang.php");
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'fr';
$langData = getLangData($lang);

?>

<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($lang); ?>">
<head>
    <meta charset="UTF-8">
    <title><?php echo t('forgotTitle', $langData); ?></title>
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
    <div class="DivAcceuil">
        <a class="BouttonAcceuil" href="../index.php"><p><?php echo t('home', $langData); ?></p></a>
    </div>

    <?php if(!isset($_GET['token'])){?>
        <div class="DivConnexion">
            <form action="MdpOublie.php" method="post">
                <h3><?php echo t('forgotHeader', $langData); ?></h3>
                <label for="email"><?php echo t('forgotEmailLabel', $langData); ?></label>
                <input type="email" id="email" name="email" required>
                <input type="submit" value="<?php echo t('forgotButton', $langData); ?>">
            </form>
        </div>
    <?php } ?>

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