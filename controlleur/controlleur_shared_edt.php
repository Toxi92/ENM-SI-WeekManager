<?php

if (!isset($_SESSION['user'])) {
    header('Location: Connexion.php');
    exit;
}
require_once(__DIR__ . '/../modele/db.edt.php');
$user = unserialize($_SESSION['user']);
$sharedEDTs = $query2->getSharedEDTs($user->getEmail());

?>