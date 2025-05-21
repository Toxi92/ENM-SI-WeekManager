<?php
include_once(__DIR__."/modele/db.user.php");
include_once(__DIR__."/controlleur/controlleur_index.php");
include_once(__DIR__."/modele/db.task.php");

if(session_status() == PHP_SESSION_NONE) {
    session_start();

}  ?>

<!DOCTYPE html>

<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/styles/style.css">

    <title>Accueil</title>

    <script src="/script/EDTtoPDF.js"></script>

</head>

<header>

    <?php

    if (!isset($_SESSION['user'])) { ?>
        <h1 class="Titre">Bienvenue</h1>
    <?php }


    if (isset($_SESSION['user'])) { ?>
        <div class="DivLogin">
                <a class="BouttonLogin" href="/vue/Profile.php"><p>Mon Profil</p></a>
        </div>
    <?php } else { ?>
        <div class="DivLogin">
            <a class="BouttonLogin" href="/vue/Connexion.php"><p>Se connecter / S'inscrire</p></a>
        </div> <?php
    }

    if (isset($_SESSION['user'])) { 
        $user = unserialize($_SESSION['user']); // Désérialiser l'objet utilisateur
        if ($user->isAdmin()==true) { ?>
            
    <?php
    }
}

?>

</header>

<body>

    <?php if (isset($_SESSION['user'])) { ?>
        <div class="DivAjoutTache">
            <a class="BouttonAjoutTache" href="/vue/Task.php">Ajout d'une tâche</a>
        </div>
        <div class="DivRemiseAZero">
            <form action="index.php?action=reset" method="post">
                <button class="BouttonRemiseAZero" type="submit">Remise à zéro</button>
            </form>
        </div>
    <?php } 
    include_once(__DIR__."/controlleur/controlleur_affiche_EDT.php");
    ?>

    

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
