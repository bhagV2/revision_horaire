# Projet Révision - Gestion des Horaires

Application web et API REST pour gérer les horaires des classes du CFPT.

## Informations
* **Nom :** Masachchige
* **Prénom :** Bhagya
* **Classe :** I.DA-P3A

## Procédure d'installation
1. Ouvrir **phpMyAdmin**.
2. Importer le fichier situé dans `sql/init.sql`.
3. Configurer les accès à la base de données dans le fichier `config/database.php`.

## URL de l'API (Méthode GET)
* **Liste des classes :**  
  `http://localhost/apache/PHP/revision_horaire/api/index.php?route=classes`
* **Liste des cours :**  
  `http://localhost/apache/PHP/revision_horaire/api/index.php?route=cours`
* **Horaire d'une classe :**  
  `http://localhost/apache/PHP/revision_horaire/api/index.php?route=cours&classe=I.DA-P3A`