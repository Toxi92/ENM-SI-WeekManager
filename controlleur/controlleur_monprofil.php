<?php

include_once("../modele/db.user.php");
include_once("../modele/db.auth.php");
if(!isset($_SESSION)){
    session_start();
}

require_once(__DIR__ . "/lang.php");
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'fr';
$langData = getLangData($lang);

if (!isset($_SESSION['user'])) {
    echo '<script>
    alert("Vous devez être connecté pour accéder à cette page.");
    window.location.href = "../index.php";
    </script>';
    exit;
}
$user = unserialize($_SESSION['user']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents("php://input"), true);
    echo $input['value'];
    echo $input['field'];
    if ($input['state'] === "plus") {
        $user->setAdmin(true); // Activer le mode admin
        $query->setAdmin($user->getEmail());
        
    } else {
        $user->setAdmin(false); // Désactiver le mode admin
        $query->setUser($user->getEmail());
    }

    if (isset($input['field']) && isset($input['value'])) {
        $field = $input['field'];
        $value = $input['value'];

        // Mettre à jour la propriété correspondante de l'utilisateur
        switch ($field) {

            case 'username':
                $user->setUsername($value);
                break;
            case 'email':
                $user->setEmail($value);
                break;
            default:
                http_response_code(400);
                echo json_encode(["success" => false, "message" => "Champ invalide."]);
                exit;
        }
        $query->updateUserField($user->getEmail(), $field, $value);
    }

    // Mettre à jour l'objet utilisateur dans la session
    $_SESSION['user'] = serialize($user);
    
}
?>