<?php
require_once(__DIR__."/../vendor/autoload.php");
require_once(__DIR__."/../modele/db.auth.php");
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
        echo "<script>alert('L\'adresse e-mail n\'est pas enregistrée.');</script>";
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
    mail($email, "WeekManager Password Reset", "Vous avez 5 minutes pour changer votre mot de passe via ce lien : ".$uniqueLink);
    }
}


if (isset($_GET['token'])) {
    $token = $_GET['token'];
    try {
        $decoded = JWT::decode($token, new Key($privateKey, 'HS256'));
        // $decoded->email contient l'email de l'utilisateur
        $email = $decoded->email;
        ?>
        <form action="../controlleur/controlleur_mdp_oublie.php" method="post" class="FormNouveauMDP">
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token']); ?>">
            <label for="new_password">Nouveau mot de passe :</label>
            <input type="password" id="new_password" name="new_password" required>
    
            <label for="confirm_password">Confirmer le mot de passe :</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
            <input type="submit" value="Valider">
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
        echo "<script>alert('Les mots de passe ne correspondent pas.');</script>";
        exit;
    } else {
        $token = $_POST['token'];
        $decoded = JWT::decode($token, new Key($privateKey, 'HS256'));
        $email = $decoded->email;
        $query->updateUserField($email, 'pwd', password_hash($newPassword, PASSWORD_DEFAULT));
        $user->changePassword($newPassword);
        mail($email, "WeekManager Password Reset", "Votre mot de passe a été changé avec succès.");
        header('Location: ../index.php');
        exit;
    }
}
?>