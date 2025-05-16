<?php require_once("../controlleur/controlleur_mdp_oublie.php"); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mot de passe oublié</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
    
    <div class="DivAcceuil">
        <a class="BouttonAcceuil" href="../index.php"><p>Accueil</p></a>
    </div>

    <?php if(!isset($_GET['token'])){?>
        <div class="DivConnexion">
        
            <form action="MdpOublie.php" method="post">
                <h3>Mot de passe oublié</h3>
                <label for="email">Adresse e-mail :</label>
                <input type="email" id="email" name="email" required>
                <input type="submit" value="Réinitialiser le mot de passe">
            
            </form>
        
        </div>
    <?php } ?>

</body>
</html>