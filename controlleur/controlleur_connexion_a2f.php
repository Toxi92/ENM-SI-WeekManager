<?php
if(!isset($_SESSION)){
    session_start();
}
require_once("../modele/db.auth.php");
require_once(__DIR__ . "/../modele/db.user.php");
require_once(__DIR__ . "/controlleur_lang.php");
require_once(__DIR__."/../vendor/autoload.php");
use Dotenv\Dotenv;
use OTPHP\TOTP;
$dotenv = Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();


$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'fr';
$langData = getLangData($lang);



if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
        $password = $_SESSION['pwd'];
        $a2f_code = $_POST['a2f_code'];
        $totp = TOTP::create($query->getSecret($email));
        if ($totp->verify($a2f_code)) {
            session_start();
            $res=$query->getUserByEmail($email);
            $user->login($res['username'], $res['pwd'], $res['email'], $res['admin']);
            $_SESSION['user'] = serialize($user);
            echo "<script>alert('".t('loginSuccess', $langData)."');
            window.location.href = '../index.php';
            </script>";
        }else {
            echo "<script>alert('".t('a2fIncorrect', $langData)."');
            window.location.href = '../vue/Connexion_A2F.php';
            </script>";
        }
    }
}

?>