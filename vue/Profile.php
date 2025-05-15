<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once("../controlleur/controlleur_monprofil.php");
?>

<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../styles/style.css">

    <script src="../script/SauvegardeProfile.js"></script>
    <script src="../script/VueAdmin.js"></script>

<title>Profile</title>

</head>

<body>
    <button id="toggleButton" class="toggle-button">+</button>
    <h1 class="Titre">Mon Profil</h1>
    
    <a class="BouttonAcceuilProfil" href="../index.php"><p>Accueil</p></a>

    
    <div>    
        <h2 class="TitreSection">Informations Personnelles</h2>
    
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
                <script src="../script/deconnexion.js"></script>
            </div>
        </div>
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