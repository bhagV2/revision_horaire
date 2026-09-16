<?php
/**
 * Fonctions de gestion pour les créneaux horaires
 * @author M.Bhagya
 */
require_once __DIR__ . '/../connexion/db.php';

/**
 * Récupère tous les créneaux d'une classe (Jointure simple)
 */
function getHorairesByClasse($classeNom) {
    $db = getConnection();
    $sql = "SELECT creneaux.id, creneaux.jour, creneaux.heure_debut, creneaux.heure_fin, creneaux.salle,
                   classes.nom AS classe, classes.annee_scolaire,
                   cours.nom AS cours, cours.code AS code_cours
            FROM creneaux
            JOIN classes ON creneaux.classe_id = classes.id
            JOIN cours ON creneaux.cours_id = cours.id
            WHERE classes.nom = :nom";
            
    $stmt = $db->prepare($sql);
    $stmt->execute(['nom' => $classeNom]);
    return $stmt->fetchAll();
}

/**
 * Ajoute un nouveau créneau horaire
 */
function addCreneau($classe_id, $cours_id, $jour, $heure_debut, $heure_fin, $salle) {
    $db = getConnection();
    $sql = "INSERT INTO creneaux (classe_id, cours_id, jour, heure_debut, heure_fin, salle) 
            VALUES (:classe_id, :cours_id, :jour, :heure_debut, :heure_fin, :salle)";
            
    $stmt = $db->prepare($sql);
    return $stmt->execute([
        'classe_id' => $classe_id,
        'cours_id' => $cours_id,
        'jour' => $jour,
        'heure_debut' => $heure_debut,
        'heure_fin' => $heure_fin,
        'salle' => $salle
    ]);
}

/**
 * Supprime un créneau horaire par son ID
 */
function deleteCreneau($id) {
    $db = getConnection();
    $stmt = $db->prepare("DELETE FROM creneaux WHERE id = :id");
    return $stmt->execute(['id' => $id]);
}
