<?php
/**
 * Fonctions de gestion pour les classes
 * @author M.Bhagya
 */
require_once __DIR__ . '/../connexion/db.php';

/**
 * Récupère toutes les classes
 */
function getAllClasses() {
    $db = getConnection();
    return $db->query("SELECT * FROM classes ORDER BY nom ASC")->fetchAll();
}

/**
 * Ajoute une nouvelle classe
 */
function addClasse($nom, $annee) {
    $db = getConnection();
    $stmt = $db->prepare("INSERT INTO classes (nom, annee_scolaire) VALUES (:nom, :annee)");
    return $stmt->execute(['nom' => $nom, 'annee' => $annee]);
}

/**
 * Supprime une classe par son ID
 */
function deleteClasse($id) {
    $db = getConnection();
    $stmt = $db->prepare("DELETE FROM classes WHERE id = :id");
    return $stmt->execute(['id' => $id]);
}
