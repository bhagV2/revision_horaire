<?php
/**
 * Point d'entrée unique de l'API REST
 * @author M.Bhagya
 */
header("Content-Type: application/json; charset=UTF-8");

require_once __DIR__ . '/../functions/classes.php';
require_once __DIR__ . '/../functions/cours.php';
require_once __DIR__ . '/../functions/creneaux.php';

$method = $_SERVER['REQUEST_METHOD'];
$route = isset($_GET['route']) ? trim($_GET['route']) : '';

if ($method === 'GET') {
    if ($route === 'classes') {
        echo json_encode(getAllClasses(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        exit;
    }

    if ($route === 'cours') {
        if (isset($_GET['classe'])) {
            $liste = getAllCreneauxByClasse(trim($_GET['classe']));
            echo json_encode($liste, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(getAllCours(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }
        exit;
    }
}

if ($method === 'POST') {
    $action = isset($_GET['action']) ? trim($_GET['action']) : '';

    if ($action === 'add_classe') {
        addClasse($_POST['nom'], $_POST['annee_scolaire']);
        echo json_encode(["statut" => "ok"]);
        exit;
    }

    if ($action === 'delete_classe') {
        deleteClasse((int)$_POST['id']);
        echo json_encode(["statut" => "ok"]);
        exit;
    }

    if ($action === 'add_creneau') {
        addCreneau($_POST['classe_id'], $_POST['cours_id'], $_POST['jour'], $_POST['heure_debut'], $_POST['heure_fin'], $_POST['salle']);
        echo json_encode(["statut" => "ok"]);
        exit;
    }

    if ($action === 'delete_creneau') {
        deleteCreneau((int)$_POST['id']);
        echo json_encode(["statut" => "ok"]);
        exit;
    }
}

http_response_code(404);
echo json_encode(["erreur" => "Route introuvable."]);
