<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails de la tâche</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
    <div class="DivDetailsTask">
        <h2>Détails de la tâche</h2>
        <?php
        include_once("../controlleur/controlleur_detailsTask.php");
        if (isset($task)) {
        ?>
            <p><strong>Nom :</strong> <?php echo htmlspecialchars($task['Nom']); ?></p>
            <p><strong>Description :</strong> <?php echo htmlspecialchars($task['Description']); ?></p>
            <form action="../controlleur/controlleur_detailsTask.php" method="post" style="margin-bottom:20px;">
                <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
                <input type="hidden" name="delete" value="">
                <input type="submit" value="Supprimer la tâche" class="BtnSupprimerTache" onclick="return confirm('Supprimer cette tâche ?');">
            </form>
            <form action="../controlleur/controlleur_detailsTask.php" method="post" class="FormCouleurTache">
                <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
                <label for="couleur">Couleur dans l'EDT :</label>
                <input type="color" id="couleur" name="couleur" value="<?php echo htmlspecialchars($task['Couleur'] ?? '#0078d7'); ?>">
                <input type="submit" value="Changer la couleur">
            </form>
        <?php
        } else {
            echo "<p>Tâche introuvable.</p>";
        }
        ?>
        <a class="BouttonAcceuil" href="../index.php">Retour à l'accueil</a>
    </div>
</body>
<footer class="Footer">
    <div class="FooterButtons">
        <a href="/vue/Contact.php" class="FooterButton">Contact</a>
        <a href="/vue/About.php" class="FooterButton">À propos</a>
        <a href="/vue/Privacy.php" class="FooterButton">Confidentialité</a>
        <a href="/vue/Help.php" class="FooterButton">Aide</a>
    </div>
</footer>
</html>