<?php
require_once(__DIR__ . "/../controlleur/controlleur_lang.php");
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'fr';
$langData = getLangData($lang);

?>

<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($lang); ?>">
<head>
    <meta charset="UTF-8">
    <title><?php echo t('notFoundTitle', $langData); ?></title>
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
    <div class="notfound-container">
        <div class="notfound-title"><?php echo t('notFoundHeader', $langData); ?></div>
        <div class="notfound-message"><?php echo t('notFoundMessage', $langData); ?></div>
        <a class="notfound-link" href="../index.php"><?php echo t('notFoundBackHome', $langData); ?></a>
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