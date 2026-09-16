<?php
/**
 * Point d'entrée de l'API REST
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
            $liste = getHorairesByClasse(trim($_GET['classe']));
            
            if (!empty($liste)) {
                echo json_encode([
                    "classe" => $_GET['classe'],
                    "annee_scolaire" => $liste[0]['annee_scolaire'] ?? '',
                    "horaires" => $liste
                ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            } else {
                http_response_code(404);
                echo json_encode(["erreur" => "Aucun creneau trouve."]);
            }
        } 
        else {
            echo json_encode(getAllCours(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }
        exit;
    }
}

http_response_code(404);
echo json_encode(["erreur" => "Route introuvable."]);