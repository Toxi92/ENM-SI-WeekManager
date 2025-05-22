<?php 
// filepath: /home/toxi/Desktop/BTS_SIO/Projet/UberPizza/Controlleur/controlleur_deconnexion.php
if(!isset($_SESSION)){
    session_start();
}


// Supprimer uniquement l'objet utilisateur de la session
if (isset($_SESSION['user'])) {
    unset($_SESSION['user']);
}

// Répondre avec un statut HTTP 200 pour indiquer le succès
http_response_code(200);
exit;
?>