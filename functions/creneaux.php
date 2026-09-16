<?php
/**
 * Fonctions de gestion pour les creneaux (CRUD)
 * @author M.Bhagya
 */
require_once __DIR__ . '/../connexion/db.php';

function getAllCreneauxByClasse($classeNom) {
    $db = getConnection();
    $sql = "SELECT creneaux.id, creneaux.jour, creneaux.heure_debut, creneaux.heure_fin, creneaux.salle,
                   cours.nom AS cours, cours.code AS code_cours
            FROM creneaux
            JOIN classes ON creneaux.classe_id = classes.id
            JOIN cours ON creneaux.cours_id = cours.id
            WHERE classes.nom = :nom
            ORDER BY FIELD(creneaux.jour, 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi'), creneaux.heure_debut ASC";
    $stmt = $db->prepare($sql);
    $stmt->execute(['nom' => $classeNom]);
    return $stmt->fetchAll();
}

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

function deleteCreneau($id) {
    $db = getConnection();
    $stmt = $db->prepare("DELETE FROM creneaux WHERE id = :id");
    return $stmt->execute(['id' => $id]);
}
