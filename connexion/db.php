<?php
/**
 * Initialisation de la connexion PDO globale (Singleton)
 * @author M.Bhagya
 */
require_once __DIR__ . '/../config/database.php';

function getConnection() {
    static $pdo = null;
    
    if ($pdo === null) {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHAR;
            $pdo = new PDO($dsn, DB_USER, DB_PASS, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(["erreur" => "Erreur réseau de base de données."]);
            exit;
        }
    }
    return $pdo;
}