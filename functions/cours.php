<?php
/**
 * Fonctions de gestion pour les cours
 * @author M.Bhagya
 */
require_once __DIR__ . '/../connexion/db.php';

/**
 * Récupère tous les cours
 */
function getAllCours() {
    $db = getConnection();
    return $db->query("SELECT * FROM cours")->fetchAll();
}

/**
 * Ajoute un nouveau cours
 */
function addCours($code, $nom) {
    $db = getConnection();
    $stmt = $db->prepare("INSERT INTO cours (code, nom) VALUES (:code, :nom)");
    return $stmt->execute(['code' => $code, 'nom' => $nom]);
}

/**
 * Supprime un cours par son ID
 */
function deleteCours($id) {
    $db = getConnection();
    $stmt = $db->prepare("DELETE FROM cours WHERE id = :id");
    return $stmt->execute(['id' => $id]);
}
