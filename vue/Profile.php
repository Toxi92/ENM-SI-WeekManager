<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once("../controlleur/controlleur_monprofil.php");
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
    <script src="../script/SauvegardeProfile.js"></script>
    <script src="../script/changeTheme.js"></script>
    <title><?php echo t('profileTitle', $langData); ?></title>
</head>
<body>
    <main>
        <button id="toggleThemeBtn">☀️/🌙</button>

        
        <h1 class="Titre"><?php echo t('profileTitle', $langData); ?></h1>
        
        <a class="BouttonAcceuilProfil" href="../index.php"><p><?php echo t('profileHome', $langData); ?></p></a>
        
        <div>    
            <h2 class="TitreSection"><?php echo t('profileSectionTitle', $langData); ?></h2>
        
            <div class="DivProfil">
                <div>
                    <label for="nom"><?php echo t('profileUsername', $langData); ?></label>
                    <input type="text" id="username" value="<?php echo $user->getUsername(); ?>" readonly>
                    <button><?php echo t('profileEdit', $langData); ?></button>
                </div>
                <div>
                    <label for="email"><?php echo t('profileEmail', $langData); ?></label>
                    <input type="text" id="email" value="<?php echo $user->getEmail(); ?>" readonly>
                    <button><?php echo t('profileEdit', $langData); ?></button>
                </div>
                <div>
                    <button id="showChangePwdBtn" type="button"><?php echo t('profileChangePwd', $langData); ?></button>
                    <form id="changePwdForm" action="../controlleur/controlleur_changement_mdp.php" method="post" style="display:none; margin-top:10px;">
                        <label for="current_password"><?php echo t('profileCurrentPwd', $langData); ?></label>
                        <input type="password" id="current_password" name="current_password" required>
                        <label for="new_password"><?php echo t('profileNewPwd', $langData); ?></label>
                        <input type="password" id="new_password" name="new_password" required>
                        <input type="hidden" name="email" value="<?php echo $user->getEmail(); ?>">
                        <input type="submit" value="<?php echo t('profileValidate', $langData); ?>">
                    </form>
                </div>
                <?php
                include_once(__DIR__ . "/../modele/db.auth.php");
                if ($query->ISa2fON($user->getEmail())) {
                    echo '<a href="../vue/DesactivationA2F.php" class="activation-a2f-btn">Désactiver la double authentification</a>';
                } else {
                    echo '<a href="../vue/ActivationA2F.php" class="activation-a2f-btn">Activer la double authentification</a>';
                }
                ?>
                <div>
                    <input type="submit" id="deconnexion" value="<?php echo t('profileLogout', $langData); ?>">
                    <script src="../script/deconnexion.js"></script>
                </div>
            </div>
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