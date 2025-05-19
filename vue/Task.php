<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une tâche</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
    <div class="DivAjoutTacheForm">
        <h2>Ajouter une tâche</h2>
        <form action="../controlleur/controlleur_ajout_task.php" method="post" class="FormAjoutTache">
            <label for="title">Nom de la tâche :</label>
            <input type="text" id="title" name="title" required>

            <label for="description">Description :</label>
            <textarea id="description" name="description" rows="3" required></textarea>

            <label for="jour">Jour :</label>
            <select id="jour" name="jour" required>
                <option value="">--Choisir un jour--</option>
                <option value="Lundi">Lundi</option>
                <option value="Mardi">Mardi</option>
                <option value="Mercredi">Mercredi</option>
                <option value="Jeudi">Jeudi</option>
                <option value="Vendredi">Vendredi</option>
            </select>

            <label for="heure_debut">Heure de début :</label>
            <select id="heure_debut" name="heure_debut" required>
                <option value="">--Choisir une heure--</option>
                <option value="08:00">08h - 09h</option>
                <option value="09:00">09h - 10h</option>
                <option value="10:00">10h - 11h</option>
                <option value="11:00">11h - 12h</option>
                <option value="12:00">12h - 13h</option>
                <option value="13:00">13h - 14h</option>
                <option value="14:00">14h - 15h</option>
                <option value="15:00">15h - 16h</option>
                <option value="16:00">16h - 17h</option>
                <option value="17:00">17h - 18h</option>
            </select>

            <label for="heure_fin">Heure de fin :</label>
            <select id="heure_fin" name="heure_fin" required>
                <option value="">--Choisir une heure--</option>
                <option value="09:00">09h - 10h</option>
                <option value="10:00">10h - 11h</option>
                <option value="11:00">11h - 12h</option>
                <option value="12:00">12h - 13h</option>
                <option value="13:00">13h - 14h</option>
                <option value="14:00">14h - 15h</option>
                <option value="15:00">15h - 16h</option>
                <option value="16:00">16h - 17h</option>
                <option value="17:00">17h - 18h</option>
                <option value="18:00">18h</option>
            </select>

            <input type="submit" value="Ajouter la tâche">
        </form>
        <a class="BouttonAcceuil" href="../index.php">Retour à l'accueil</a>
    </div>
</body>
</html>