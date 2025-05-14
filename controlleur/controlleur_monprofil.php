<?php

include_once("../modele/db.user.php");
include_once("../modele/db.auth.php");
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: ../index.php');
    exit;
}
$user = unserialize($_SESSION['user']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents("php://input"), true);
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