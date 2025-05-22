<?php require_once("../controlleur/controlleur_mail_support.php"); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Contact</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>

<header>
    <div class="DivAcceuil">
        <a class="BouttonAcceuil" href="../index.php"><p>Accueil</p></a>
    </div>
</header>

<body>
    <h1>Contact</h1>
    <p>Pour toute question ou suggestion, vous pouvez nous écrire à l'adresse suivante :</p>
    <p><a href="mailto:edgar.mlrd@gmail.com">edgar.mlrd@gmail.com</a></p>
    <div class="DivContact">
        <form method="post" action="/../controlleur/controlleur_mail_support.php">
        <label for="email">Votre email :</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="name">Votre nom :</label><br>
        <input type="text" id="name" name="name" required><br>
        <label for="subject">Objet :</label><br>
        <input type="text" id="subject" name="subject" required><br>
        <label for="message">Votre message :</label><br>
        <textarea id="message" name="message" rows="5" required></textarea><br>
        <button type="submit">Envoyer</button>
    </form>
    </div>

</body>

<footer class="Footer">
    <div class="FooterButtons">
        <a href="./Contact.php" class="FooterButton">Contact</a>
        <a href="./About.php" class="FooterButton">À propos</a>
        <a href="./Confidentialite.php" class="FooterButton">Confidentialité</a>
        <a href="./Aide.php" class="FooterButton">Aide</a>
    </div>
</footer>

</html>