<?php
/**
 * En-tête
 * @author M.Bhagya
 */
$root = str_replace('/includes', '', dirname($_SERVER['SCRIPT_NAME']));
$root = str_replace('/pages', '', dirname($_SERVER['SCRIPT_NAME']));
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Projet Horaire - CFPT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
<header class="bg-white border-bottom py-2 mb-4 shadow-sm">
    <nav class="container">
        <ul class="nav flex">
            <li class="nav-item"><a class="nav-link" href="<?= $root ?>/index.php">Accueil</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= $root ?>/pages/classes.php">Classes</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= $root ?>/pages/cours.php">Cours</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= $root ?>/pages/horaire.php">Horaire</a></li>
        </ul>
    </nav>
</header>
<main class="container">
