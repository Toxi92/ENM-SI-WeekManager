<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once("../Controlleur/controlleur_monprofil.php");
?>

<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../styles/style1.css">

    <script src="../Script/sauvegardeProfile.js"></script>
    <script src="../Script/VueAdmin.js"></script>

<title>Profile</title>

</head>

<body>
    <button id="toggleButton" class="toggle-button">+</button>
    <h1 class="Titre">Mon Profil</h1>
    
    <a class="BouttonAcceuilProfil" href="./index.php"><p>Accueil</p></a>

    
    <div>    
        <h2 class="TitreSection">Informations Personnelles</h2>

        <div>    
        <div class="DivProfil">
            <div>
                <label for="nom">Username :</label>
                <input type="text" id="username" value="<?php echo $user->getUsername(); ?>" readonly>
                <button>Modifier</button>

            <div>
                <label for="email">Email :</label>
                <input type="text" id="email" value="<?php echo $user->getEmail(); ?>" readonly>
                <button>Modifier</button>
            </div>




            <div>
                <input type="submit" id="deconnexion" value="Déconnexion">
                <script src="../Script/deconnexion.js"></script>
        </div>
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