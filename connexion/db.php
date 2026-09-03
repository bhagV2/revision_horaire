<?php
/**
 * Affichage d'une liste d'animaux
 * @author M.Bhagya
 */
require_once "../config/database.php";

function db() : PDO
{
    static $db = null;

    if ($db === null) {
        // Se connecter à la base de données
        $db = new PDO(
            "mysql:host=". DB_HOST .";dbname=". DB_NAME .";charset=". DB_CHAR, DB_USER, DB_PASS
        );

        // Configurer la connexion à la DB
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }
    
    return $db;
}