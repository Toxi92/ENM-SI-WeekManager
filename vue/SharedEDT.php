<?php
// Page qui liste les emplois du temps partagés avec l'utilisateur connecté
session_start();
require_once(__DIR__ . '/../controlleur/controlleur_lang.php');
require_once(__DIR__ . '/../controlleur/controlleur_shared_edt.php');

$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'fr';
$langData = getLangData($lang);

?>
<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($lang); ?>">
<head>
    <meta charset="UTF-8">
    <title><?php echo t('sharedEDTTitle', $langData); ?></title>
    <link id='Style_theme' rel="stylesheet" href="../styles/style.css">
    <script src="../script/changeTheme.js"></script>
</head>
<body class="sharededt-body">
    <main>
        <h1 class="Titre sharededt-title"><?php echo t('sharedEDTTitle', $langData); ?></h1>
        <div class="DivProfil sharededt-list">
            <?php if (empty($sharedEDTs)) { ?>
                <p><?php echo t('sharedEDTNone', $langData); ?></p>
            <?php } else { ?>
                <ul>
                <?php foreach ($sharedEDTs as $edt) { ?>
                    <li class="sharededt-item">
                        <strong><?php echo t('sharedEDTOwner', $langData); ?></strong> <?php echo htmlspecialchars($query2->getEDTOwner($edt['id'])['username'] ); ?>
                        | <strong><?php echo t('sharedEDTRank', $langData); ?></strong> <?php echo t('sharedEDTRank' . intval($edt['rang']), $langData); ?>
                        | <a class="sharededt-view" href="./AfficheSharedEDT.php?edt_owner_email=<?php echo urlencode($query2->getEDTOwner($edt['id'])['email']); ?>&edt_id=<?php echo urlencode($edt['id'])?>"><?php echo t('sharedEDTView', $langData); ?></a>
                    </li>
                <?php  } ?>
                </ul>
            <?php } ?>
        </div>
        <a class="BouttonAcceuilProfil sharededt-back" href="../index.php"><?php echo t('sharedEDTBackHome', $langData); ?></a>
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
