<?php
/**
 * Page d'accueil simple
 * @author M.Bhagya
 */
?>
<?php include("includes/header.php"); ?>

<div class="p-4 bg-white rounded border my-4">
    <h1>Gestion des Horaires - CFPT</h1>
    <p>Bienvenue sur l'application de consultation et de gestion des emplois du temps.</p>
</div>
<div class="row g-3">
    <div class="col-md-4">
        <div class="card p-3 text-center">
            <h3>Classes</h3>
            <a href="pages/classes.php" class="btn btn-primary mt-2">Gérer les classes</a>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-3 text-center">
            <h3>Cours</h3>
            <a href="pages/cours.php" class="btn btn-primary mt-2">Gérer les cours</a>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-3 text-center">
            <h3>Horaires</h3>
            <a href="pages/horaire.php" class="btn btn-success mt-2">Consulter l'horaire</a>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>
