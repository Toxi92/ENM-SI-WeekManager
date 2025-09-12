<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once("../controlleur/controlleur_monprofil.php");
require_once(__DIR__ . "/../controlleur/controlleur_lang.php");
require_once(__DIR__ . "/../modele/db.user.php");
$user = unserialize($_SESSION['user']);
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'fr';
$langData = getLangData($lang);

?>

<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($lang); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../favicon.ico">
    <link  id='Style_theme' rel="stylesheet" href="../styles/style.css">
    <script src="../script/SauvegardeProfile.js"></script>    <script src="../script/changeTheme.js"></script>
    <title>ENM WEEK MANAGER</title>
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
                    <button class="edit-btn"><?php echo t('profileEdit', $langData); ?></button>
                </div>
                <div>
                    <label for="email"><?php echo t('profileEmail', $langData); ?></label>
                    <input type="text" id="email" value="<?php echo $user->getEmail(); ?>" readonly>
                    <button class="edit-btn"><?php echo t('profileEdit', $langData); ?></button>
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
                    echo '<a href="../controlleur/controlleur_desactivation_a2f.php" class="activation-a2f-btn">' . t('a2fDeactivateButton', $langData) . '</a>';
                } else {
                    echo '<a href="../vue/ActivationA2F.php" class="activation-a2f-btn" >' . t('a2fActivateButton', $langData) . '</a>';
                }
                ?>

                <div style="margin-top:20px;">
                    <button id="btnShareEDT" type="button" style="background:#555b63;color:#ffd700;border-radius:5px;padding:10px 18px;font-weight:bold;cursor:pointer;"><?php echo t('profileShareEDTButton', $langData); ?></button>
                    <form id="formShareEDT" action="../controlleur/controlleur_partage_edt.php" method="post" style="display:none;margin-top:10px;">
                        <label for="share_email"><?php echo t('shareEmailLabel', $langData); ?></label>
                        <input type="email" id="share_email" name="share_email" required>
                        <label for="share_rank"><?php echo t('shareRankLabel', $langData); ?></label>
                        <select id="share_rank" name="share_rank" required>
                            <option value="1"><?php echo t('sharedEDTRank1', $langData); ?></option>
                            <option value="2"><?php echo t('sharedEDTRank2', $langData); ?></option>
                        </select>
                        <input type="hidden" name="owner_email" value="<?php echo $user->getEmail(); ?>">
                        <button type="submit" style="background:#ffd700;color:#2c2f33;border-radius:5px;padding:8px 16px;font-weight:bold;margin-top:8px;"><?php echo t('shareSubmit', $langData); ?></button>
                    </form>
                    <script>
                    document.getElementById('btnShareEDT').onclick = function() {
                        var form = document.getElementById('formShareEDT');
                        form.style.display = (form.style.display === 'none') ? 'block' : 'none';
                    };
                    </script>
                    <?php if(count($query2->getListWhoHaveAccess($user->getEmail()))!=0){?>
                    <h3 style="margin-top:20px;">&nbsp;<?php echo t('profileSharedEDTTitle', $langData); ?></h3>
                    <ul>
                        <?php foreach ($query2->getListWhoHaveAccess($user->getEmail()) as $sharedEDT) { ?>
                            <li>
                                <?php echo htmlspecialchars($sharedEDT['username']) . " | "; ?>
                                <?php echo htmlspecialchars($sharedEDT['email']) . " | "; ?>
                                <?php if(intval($sharedEDT['rang'])==1) {echo "Permission(s) : " . t('sharedEDTRank1', $langData);}elseif(intval($sharedEDT['rang'])==2){echo "Pemission(s) : " . t('sharedEDTRank2', $langData);} ?>
                                <form action="../controlleur/controlleur_supression_share_access.php" method="post" style="display:inline;">
                                    <input type="hidden" name="emailToRemove" value="<?php echo htmlspecialchars($sharedEDT['email']); ?>">
                                    <input type="hidden" name="emailFromTo" value="<?php echo $user->getEmail(); ?>">
                                    <button type="submit" style="background:#ff4d4d;color:#fff;border-radius:5px;padding:5px 10px;font-weight:bold;cursor:pointer;">&nbsp;<?php echo t('profileRemoveAccess', $langData); ?></button>
                                </form>
                            </li>
                        <?php } ?>
                    </ul>
                    <?php } ?>
                </div>
            </div>
            <div>
                <input type="submit" id="deconnexion" value="<?php echo t('profileLogout', $langData); ?>">
                <script src="../script/deconnexion.js"></script>
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