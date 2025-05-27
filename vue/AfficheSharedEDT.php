<?php
include_once(__DIR__ . "/../controlleur/controlleur_affiche_shared_edt.php");


?>

<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($lang); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link  id='Style_theme' rel="stylesheet" href="/styles/style.css">
    <script src="/script/changeTheme.js"></script>
    <title><?php echo t('homeTitle', $langData); ?></title>
    <script src="/script/EDTtoPDF.js"></script>
    <script>
    var jsTranslations = {
        download: "<?php echo t('btnDownloadEDT', $langData); ?>",
        print: "<?php echo t('btnPrintEDT', $langData); ?>",
        notFound: "<?php echo t('edtNotFound', $langData); ?>"
    };
</script>
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
        <a href="/vue/Contact.php" class="FooterButton"><?php echo t('footerContact', $langData); ?></a>
        <a href="/vue/About.php" class="FooterButton"><?php echo t('footerAbout', $langData); ?></a>
        <a href="/vue/Confidentialite.php" class="FooterButton"><?php echo t('footerConfidentialite', $langData); ?></a>
        <a href="/vue/Aide.php" class="FooterButton"><?php echo t('footerAide', $langData); ?></a>
        <div class="LangSelector" style="position:absolute;top:10px;right:10px;">
            <form method="post" action="">
                <button type="submit" name="lang" value="fr" style="background:none;border:none;padding:0;cursor:pointer;">
                    <img src="/images/fr.png" alt="Français" width="32" height="20">
                </button>
                <button type="submit" name="lang" value="en" style="background:none;border:none;padding:0;cursor:pointer;">
                    <img src="/images/en.png" alt="English" width="32" height="20">
                </button>
            </form>
        </div>
    </div>
</footer>
</html>
