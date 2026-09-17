<?php
/**
 * Point d'entrée unique de l'API
 * @author M.Bhagya
 */
define("ROOT", __DIR__ . "/..");

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

require_once ROOT . '/functions/classes.php';
require_once ROOT . '/functions/cours.php';
require_once ROOT . '/functions/creneaux.php';

$method = $_SERVER['REQUEST_METHOD'];
$route  = filter_input(INPUT_GET, 'route', FILTER_SANITIZE_SPECIAL_CHARS);
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_SPECIAL_CHARS);

$route  = $route ? trim($route) : '';
$action = $action ? trim($action) : '';

$body = file_get_contents("php://input");
$inputData = [];
if ($body !== false && $body !== "") {
    $inputData = json_decode($body, true) ?? [];
}

$data = $inputData;

switch ($method) {
    case "GET":
        $reponse = traiterGet($route);
        break;
    case "POST":
        $reponse = traiterPost($action, $data);
        break;
    default:
        $reponse = traiterAutre();
        break;
}

envoyerReponse($reponse);

// -------------------------------------------------------------
// Fonctions de traitement de l'API
// -------------------------------------------------------------

/**
 * Gère la récupération de données (GET)
 */
function traiterGet(string $route): array {
    if ($route === 'classes') {
        return [
            "code" => 200,
            "data" => getAllClasses()
        ];
    }

    if ($route === 'cours') {
        $classe = filter_input(INPUT_GET, 'classe', FILTER_DEFAULT);
        if ($classe !== null && $classe !== false) {
            $liste = getAllCreneauxByClasse(trim($classe));
            return ["code" => 200, "data" => $liste];
        }
        return [
            "code" => 200, 
            "data" => getAllCours()
        ];
    }

    return [
        "code" => 404,
        "data" => ["erreur" => "Route introuvable."]
    ];
}

/**
 * Gère l'envoi de données (POST)
 */
function traiterPost(string $action, array $data): array {
    switch ($action) {
        case 'add_classe':
            if (empty($data['nom']) || empty($data['annee_scolaire'])) {
                return [
                    "code" => 400, 
                    "data" => ["erreur" => "Données manquantes."]
                ];
            }
            addClasse($data['nom'], $data['annee_scolaire']);
            return [
                "code" => 200, 
                "data" => ["statut" => "ok"]
            ];

        case 'delete_classe':
            if (empty($data['id'])) {
                return [
                    "code" => 400, 
                    "data" => ["erreur" => "Identifiant manquant."]
                ];
            }
            deleteClasse((int)$data['id']);
            return [
                "code" => 200, 
                "data" => ["statut" => "ok"]
            ];

        case 'add_creneau':
            $requis = ['classe_id', 'cours_id', 'jour', 'heure_debut', 'heure_fin', 'salle'];
            foreach ($requis as $champ) {
                if (empty($data[$champ])) {
                    return [
                        "code" => 400, 
                        "data" => ["erreur" => "Le champ {$champ} est requis."]
                    ];
                }
            }
            addCreneau($data['classe_id'], $data['cours_id'], $data['jour'], $data['heure_debut'], $data['heure_fin'], $data['salle']);
            return [
                "code" => 200, 
                "data" => ["statut" => "ok"]
            ];

        case 'delete_creneau':
            if (empty($data['id'])) {
                return [
                    "code" => 400, 
                    "data" => ["erreur" => "Identifiant manquant."]
                ];
            }
            deleteCreneau((int)$data['id']);
            return [
                "code" => 200, 
                "data" => ["statut" => "ok"]
            ];

        default:
            return [
                "code" => 404, 
                "data" => ["erreur" => "Action POST inconnue."]
            ];
    }
}

/**
 * Gère les méthodes non-traitées
 */
function traiterAutre(): array {
    return [
        "code" => 405,
        "data" => ["erreur" => "La méthode n'est pas autorisée."]
    ];
}

/**
 * Affichage de la réponse
 */
function envoyerReponse(array $reponse): void {
    http_response_code($reponse['code']);
    echo json_encode($reponse['data'], JSON_PRETTY_PRINT);
    exit();
}
