<?php
if(!isset($_SESSION)){
    session_start();
}


require_once(__DIR__ . "/controlleur_lang.php");
require_once(__DIR__ . "/../modele/db.user.php");
require_once("../modele/db.auth.php");
require_once(__DIR__."/../vendor/autoload.php");

use OTPHP\TOTP;
use BaconQrCode\Renderer\GDLibRenderer;
use BaconQrCode\Writer;

$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'fr';
$langData = getLangData($lang);

if(!isset($_SESSION['user'])) {
    echo "<script>alert('".t('loginRequired', $langData)."'); 
    window.location.href = '../vue/Connexion.php';
    </script>";
    exit;
}


$totp = TOTP::create();
$totp->setLabel('ENM-WeekManager');
$totp->setIssuer('ENM-WeekManager');
$secret = $totp->getSecret();

$user = unserialize($_SESSION['user']);
$query->setA2f($user->getEmail());
$query->setSecret($user->getEmail(), $secret);





$renderer = new GDLibRenderer(400);
$writer = new Writer($renderer);
$writer->writeFile($totp->getProvisioningUri(), 'qrcode.png');


echo "<img src='qrcode.png' alt='QR Code' style='width: 200px; height: 200px;'><br>";
echo '<p>'.t('a2fEnterCode',$langData).'</p>';
echo $secret;
