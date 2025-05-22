<?php
include_once(__DIR__."/modele/db.user.php");
include_once(__DIR__."/controlleur/controlleur_index.php");
include_once(__DIR__."/modele/db.task.php");
require_once(__DIR__ . "/controlleur/controlleur_lang.php");

if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'fr';
$langData = getLangData($lang);

?>

<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($lang); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/style.css">
    <title><?php echo t('homeTitle', $langData); ?></title>
    <script src="/script/EDTtoPDF.js"></script>
</head>

<header>
    <?php if (!isset($_SESSION['user'])) { ?>
        <h1 class="Titre"><?php echo t('homeTitle', $langData); ?></h1>
    <?php } ?>

    <?php if (isset($_SESSION['user'])) { ?>
        <div class="DivLogin">
            <a class="BouttonLogin" href="/vue/Profile.php"><p><?php echo t('homeProfile', $langData); ?></p></a>
        </div>
    <?php } else { ?>
        <div class="DivLogin">
            <a class="BouttonLogin" href="/vue/Connexion.php"><p><?php echo t('homeLogin', $langData); ?></p></a>
        </div>
    <?php }

    if (isset($_SESSION['user'])) { 
        $user = unserialize($_SESSION['user']);
        if ($user->isAdmin()==true) { ?>
            <!-- Admin-specific content can go here -->
        <?php }
    }
    ?>
</header>

<body>
    <?php if (isset($_SESSION['user'])) { ?>
        <div class="DivAjoutTache">
            <a class="BouttonAjoutTache" href="/vue/Task.php"><?php echo t('homeAddTask', $langData); ?></a>
        </div>
        <div class="DivRemiseAZero">
            <form action="index.php?action=reset" method="post">
                <button class="BouttonRemiseAZero" type="submit"><?php echo t('homeReset', $langData); ?></button>
            </form>
        </div>
    <?php } 
    include_once(__DIR__."/controlleur/controlleur_affiche_EDT.php");
    ?>
</body>

<footer class="Footer">
    <div class="FooterButtons">
        <a href="/vue/Contact.php" class="FooterButton"><?php echo t('footerContact', $langData); ?></a>
        <a href="/vue/About.php" class="FooterButton"><?php echo t('footerAbout', $langData); ?></a>
        <a href="/vue/Confidentialite.php" class="FooterButton"><?php echo t('footerConfidentialite', $langData); ?></a>
        <a href="/vue/Aide.php" class="FooterButton"><?php echo t('footerAide', $langData); ?></a>
    </div>
</footer>
</html>