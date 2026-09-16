<?php
/**
 * En-tête
 * @author M.Bhagya
 */
$root = str_replace('/includes', '', dirname($_SERVER['SCRIPT_NAME']));
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Projet Horaire - CFPT</title>
    <link href="<?= $root ?>/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<header class="bg-white border-bottom py-2 mb-4 shadow-sm">
    <nav class="container">
        <ul class="nav">
            <li class="nav-item"><a class="nav-link" href="<?= $root ?>/index.php">Accueil</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= $root ?>/pages/classes.php">Classes</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= $root ?>/pages/cours.php">Cours</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= $root ?>/pages/horaire.php">Horaire</a></li>
        </ul>
    </nav>
</header>
<main class="container">
