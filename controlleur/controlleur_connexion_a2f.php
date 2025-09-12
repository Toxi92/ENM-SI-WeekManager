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
        // Do not read/store password from session; only the email and A2F code are needed here
        $a2f_code = isset($_POST['a2f_code']) ? trim($_POST['a2f_code']) : null;
        if ($a2f_code === null) {
            $_SESSION['a2f_error'] = t('a2fIncorrect', $langData);
            header('Location: ../vue/Connexion_A2F.php');
            exit;
        }
        // Basic format check (6 digits)
        if (!ctype_digit($a2f_code) || strlen($a2f_code) !== 6) {
            $_SESSION['a2f_error'] = t('a2fIncorrect', $langData);
            header('Location: ../vue/Connexion_A2F.php');
            exit;
        }
        $secret = $query->getSecret($email);
        if (empty($secret)) {
            $_SESSION['a2f_error'] = t('a2fIncorrect', $langData);
            header('Location: ../vue/Connexion.php');
            exit;
        }
        $totp = TOTP::create($secret);
        if ($totp->verify($a2f_code)) {
            $res=$query->getUserByEmail($email);
            $user->login($res['username'], $res['pwd'], $res['email'], $res['admin']);
            $_SESSION['user'] = serialize($user);
            echo "<script>alert('".t('loginSuccess', $langData)."');
            window.location.href = '../index.php';
            </script>";
        }else {
            $_SESSION['a2f_error'] = t('a2fIncorrect', $langData);
            header('Location: ../vue/Connexion_A2F.php');
            exit;
        }
    } else {
        // No email in session: user likely accessed A2F page directly or session expired
        $_SESSION['a2f_error'] = t('a2fIncorrect', $langData);
        header('Location: ../vue/Connexion.php');
        exit;
    }
}

?>