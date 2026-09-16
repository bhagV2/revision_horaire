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
    return $db->query("SELECT * FROM classes")->fetchAll();
}

/**
 * Ajoute une nouvelle classe
 */
function addClasse($nom, $annee_scolaire) {
    $db = getConnection();
    $stmt = $db->prepare("INSERT INTO classes (nom, annee_scolaire) VALUES (:nom, :annee_scolaire)");
    return $stmt->execute(['nom' => $nom, 'annee_scolaire' => $annee_scolaire]);
}

/**
 * Supprime une classe par son ID
 */
function deleteClasse($id) {
    $db = getConnection();
    $stmt = $db->prepare("DELETE FROM classes WHERE id = :id");
    return $stmt->execute(['id' => $id]);
}
