<?php
include_once(__DIR__."/modele/db.user.php");
include_once(__DIR__."/controlleur/controlleur_index.php");
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

</head>

<header>
    <h1 class="Titre">Bienvenue</h1>
    <?php

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
