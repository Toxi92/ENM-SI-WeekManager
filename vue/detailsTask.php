<?php
include_once("../controlleur/controlleur_detailsTask.php");
require_once(__DIR__ . "/../controlleur/controlleur_lang.php");
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'fr';
$langData = getLangData($lang);

?>
<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($lang); ?>">
<head>
    <meta charset="UTF-8">
    <title><?php echo t('taskDetailsTitle', $langData); ?></title>
    <link  id='Style_theme' rel="stylesheet" href="../styles/style.css">
    <script src="../script/changeTheme.js"></script>
</head>
<body>
    <main>
        <div class="DivDetailsTask">
            <h2><?php echo t('taskDetailsTitle', $langData); ?></h2>
            <?php
            if (isset($task)) {
            ?>
                <p><strong><?php echo t('taskName', $langData); ?></strong> <?php echo htmlspecialchars($task['Nom']); ?></p>
                <p><strong><?php echo t('taskDescription', $langData); ?></strong> <?php echo htmlspecialchars($task['Description']); ?></p>
                <form action="../controlleur/controlleur_detailsTask.php" method="post" style="margin-bottom:20px;">
                    <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
                    <input type="hidden" name="delete" value="">
                    <input type="submit" value="<?php echo t('taskDelete', $langData); ?>" class="BtnSupprimerTache" onclick="return confirm('<?php echo t('taskDeleteConfirm', $langData); ?>');">
                </form>
                <form action="../controlleur/controlleur_detailsTask.php" method="post" class="FormCouleurTache">
                    <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
                    <label for="couleur"><?php echo t('taskColorLabel', $langData); ?></label>
                    <input type="color" id="couleur" name="couleur" value="<?php echo htmlspecialchars($task['Couleur'] ?? '#0078d7'); ?>">
                    <input type="submit" value="<?php echo t('taskColorChange', $langData); ?>">
                </form>
            <?php
            } else {
                echo "<p>" . t('taskNotFound', $langData) . "</p>";
            }
            ?>
            <a class="BouttonAcceuil" href="../index.php"><?php echo t('backHome', $langData); ?></a>
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