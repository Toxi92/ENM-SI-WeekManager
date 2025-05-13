<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>

<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../styles/style1.css">

    <title>Inscription</title>

</head>

<header>

<div class="DivAcceuil">
        <a class="BouttonAcceuil" href="../index.php"><p>Accueil</p></a>
    </div>

</header>

<body>

    <div class="DivConnexion">
        <form action="Inscription.php" method="post" id="formulaire_inscription">
            <label for="username">Nom d'utilisateur :</label>
            <input type="text" id="username" name="username" required>
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>
            <label for="password">Confirmation mot de passe</label>
            <input type="password" id="passwordconfirm" name="passwordconfirm" required>
            <input type="submit" value="Continuer l'inscription">
            <a class="BouttonInscription" href="./Connexion.php"><p>Vous avez déjà un compte ?</p></a>
        </form>
            <?php
            require_once("../controlleur/controlleur_inscription.php");
            ?>
    </div>
    
</body>

<footer>
    <div class="banderole_bas">
        <a class="ligne_banderole_bas" href="./mentions_legale.html"><p>Mentions Légales</p></a>
        <a class="ligne_banderole_bas" href="./get_partenaires_by_bdd.php"><p>Sites partenaires</p></a>
        <a class="ligne_banderole_bas" href="https://www.youtube.com/watch?v=G3e-cpL7ofc&pp=ygUGI3dlcHVp"><p>Arrêter d'être nul en HTML/CSS ( à regarder )</p></a>
        <a class="ligne_banderole_bas" href="/rien.html"><p>Plus trop d'idées</p></a>
    </div>
</footer>

</html>