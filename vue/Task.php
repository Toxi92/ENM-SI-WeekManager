<?php
include_once("../controlleur/controlleur_ajout_task.php"); 
require_once(__DIR__ . "/../controlleur/controlleur_lang.php");
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'fr';
$langData = getLangData($lang);

?>
<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($lang); ?>">
<head>
    <meta charset="UTF-8">
    <title><?php echo t('taskAddTitle', $langData); ?></title>
    <link  id='Style_theme' rel="stylesheet" href="../styles/style.css">
    <script src="../script/changeTheme.js"></script>
</head>
<body>
    <main>
        <div class="DivAjoutTacheForm">
            <h2><?php echo t('taskAddTitle', $langData); ?></h2>
            <form action="../controlleur/controlleur_ajout_task.php" method="post" class="FormAjoutTache">
                <label for="title"><?php echo t('taskFormName', $langData); ?></label>
                <input type="text" id="title" name="title" required>

                <label for="description"><?php echo t('taskFormDescription', $langData); ?></label>
                <textarea id="description" name="description" rows="3" required></textarea>

                <label for="jour"><?php echo t('taskFormDay', $langData); ?></label>
                <select id="jour" name="jour" required>
                    <option value=""><?php echo t('taskFormDayPlaceholder', $langData); ?></option>
                    <option value="Lundi"><?php echo t('taskFormDayMonday', $langData); ?></option>
                    <option value="Mardi"><?php echo t('taskFormDayTuesday', $langData); ?></option>
                    <option value="Mercredi"><?php echo t('taskFormDayWednesday', $langData); ?></option>
                    <option value="Jeudi"><?php echo t('taskFormDayThursday', $langData); ?></option>
                    <option value="Vendredi"><?php echo t('taskFormDayFriday', $langData); ?></option>
                </select>

                <label for="heure_debut"><?php echo t('taskFormStart', $langData); ?></label>
                <select id="heure_debut" name="heure_debut" required>
                    <option value=""><?php echo t('taskFormStartPlaceholder', $langData); ?></option>
                    <option value="08:00">08:00</option>
                    <option value="09:00">09:00</option>
                    <option value="10:00">10:00</option>
                    <option value="11:00">11:00</option>
                    <option value="12:00">12:00</option>
                    <option value="13:00">13:00</option>
                    <option value="14:00">14:00</option>
                    <option value="15:00">15:00</option>
                    <option value="16:00">16:00</option>
                    <option value="17:00">17:00</option>
                </select>

                <label for="heure_fin"><?php echo t('taskFormEnd', $langData); ?></label>
                <select id="heure_fin" name="heure_fin" required>
                    <option value=""><?php echo t('taskFormEndPlaceholder', $langData); ?></option>
                    <option value="09:00">09:00</option>
                    <option value="10:00">10:00</option>
                    <option value="11:00">11:00</option>
                    <option value="12:00">12:00</option>
                    <option value="13:00">13:00</option>
                    <option value="14:00">14:00</option>
                    <option value="15:00">15:00</option>
                    <option value="16:00">16:00</option>
                    <option value="17:00">17:00</option>
                    <option value="18:00">18:00</option>
                </select>

                <input type="submit" value="<?php echo t('taskFormSubmit', $langData); ?>">
            </form>
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