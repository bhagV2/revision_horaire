<?php
/**
 * Barre de navigation
 * @author M.Bhagya
 */

$root = str_replace('/includes', '', dirname($_SERVER['SCRIPT_NAME']));
?>
<header class="bg-light border-bottom py-2">
    <nav class="container">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="<?= $root ?>/index.php">Accueil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= $root ?>/pages/classes.php">Classes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= $root ?>/pages/cours.php">Cours</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= $root ?>/pages/horaire.php">Horaire</a>
            </li>
        </ul>
    </nav>
</header>
