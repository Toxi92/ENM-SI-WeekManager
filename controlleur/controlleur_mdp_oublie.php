<?php

if(!isset($_SESSION)){
    session_start();
}

require_once(__DIR__."/../vendor/autoload.php");
require_once(__DIR__."/../modele/db.auth.php");
require_once(__DIR__ . "/controlleur_lang.php");
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'fr';
$langData = getLangData($lang);

use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$privateKey = $_ENV['JWT_KEY'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $email = $_POST['email'];
    if($query->isMailUsed($email)==False){
        http_response_code(400);
        echo "<script>alert('".t('forgotMailNotRegistered', $langData)."');</script>";
        exit;
    }else{
        $dateCreation = time();
        $dateExpiration = $dateCreation + 60*5; // 5 minutes
        $payload = [
            'email' => $email,
            'iat' => $dateCreation,
            'exp' => $dateExpiration,
        ];
        $token = JWT::encode($payload, $privateKey, 'HS256');
        $uniqueLink = "https://molard.alwaysdata.net/vue/MdpOublie.php?token=". urlencode($token);
        $subject = t('forgotMailSubject', $langData);
        $body = str_replace('{link}', $uniqueLink, t('forgotMailBody', $langData));
        mail($email, $subject, $body);
    }
}

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    try {
        $decoded = JWT::decode($token, new Key($privateKey, 'HS256'));
        $email = $decoded->email;
        ?>
        <form action="../controlleur/controlleur_mdp_oublie.php" method="post" class="FormNouveauMDP">
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token']); ?>">
            <label for="new_password"><?php echo t('profileNewPwd', $langData); ?></label>
            <input type="password" id="new_password" name="new_password" required>
    
            <label for="confirm_password"><?php echo t('registerPasswordConfirm', $langData); ?></label>
            <input type="password" id="confirm_password" name="confirm_password" required>
            <input type="submit" value="<?php echo t('profileValidate', $langData); ?>">
        </form>
        <?php
    } catch (Exception $e) {
        header('Location: ../vue/NotFound.php');
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];
    
    if ($newPassword !== $confirmPassword) {
        http_response_code(400);
        echo "<script>alert('".t('forgotPwdNotMatch', $langData)."');</script>";
        exit;
    } else {
        $token = $_POST['token'];
        $decoded = JWT::decode($token, new Key($privateKey, 'HS256'));
        $email = $decoded->email;
        $query->updateUserField($email, 'pwd', password_hash($newPassword, PASSWORD_DEFAULT));
        $user->changePassword($newPassword);
        $subject = t('forgotMailSubject', $langData);
        $body = t('forgotMailSuccess', $langData);
        mail($email, $subject, $body);
        header('Location: ../index.php');
        exit;
    }
}
?>