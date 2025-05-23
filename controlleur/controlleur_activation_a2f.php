<?php
if(!isset($_SESSION)){
    session_start();
}
require_once(__DIR__ . "/controlleur_lang.php");
require_once(__DIR__ . "/../modele/db.user.php");
require_once("../modele/db.auth.php");

$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'fr';
$langData = getLangData($lang);

require_once(__DIR__."/../vendor/autoload.php");
use OTPHP\TOTP;
$totp = TOTP::create();
$totp->setLabel('ENM-WeekManager');
$totp->setIssuer('ENM-WeekManager');
$secret = $totp->getSecret();
$query = new QueryUser($bdd);
$query->setSecret($user->getEmail(), $secret);
$query->setA2f($user->getEmail());

echo '<p>Clé à saisir manuellement : </p>';
echo $secret;
