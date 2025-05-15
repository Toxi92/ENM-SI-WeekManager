<!DOCTYPE html>

<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../styles/style.css">

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

<footer class="Footer">
    <div class="FooterButtons">
        <a href="/vue/Contact.php" class="FooterButton">Contact</a>
        <a href="/vue/About.php" class="FooterButton">À propos</a>
        <a href="/vue/Privacy.php" class="FooterButton">Confidentialité</a>
        <a href="/vue/Help.php" class="FooterButton">Aide</a>
    </div>
</footer>
</html>