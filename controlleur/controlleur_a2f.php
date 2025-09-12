<?php
if(!isset($_SESSION)){
    session_start();
}

require_once(__DIR__."/../vendor/autoload.php");
require_once(__DIR__ . "/controlleur_lang.php");
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'fr';
$langData = getLangData($lang);

use Dotenv\Dotenv;
use Twilio\Rest\Client;

$dotenv = Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();

$accountSID = $_ENV['ACCOUNT_SID'];
$authToken = $_ENV['AUTH_TOKEN'];
$serviceSID = $_ENV['SERVICE_SID'];

$client = new Client($accountSID, $authToken);

?>