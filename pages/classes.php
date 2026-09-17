<?php
define('ROOT', '..');
require_once ROOT . '/config/application.php';
require_once ROOT . '/functions/classes.php';

$message = "";

$delete_id = filter_input(INPUT_GET, 'delete_id', FILTER_VALIDATE_INT);
if ($delete_id) {
    deleteClasse($delete_id);
    header("Location: classes.php");
    exit();
}

$method = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_DEFAULT);
if ($method === 'POST') {
    $nom   = filter_input(INPUT_POST, 'nom', FILTER_DEFAULT);
    $annee = filter_input(INPUT_POST, 'annee_scolaire', FILTER_DEFAULT);

    if (!empty($nom) && !empty($annee)) {
        addClasse(trim($nom), trim($annee));
        header("Location: classes.php");
        exit();
    } else {
        $message = "Veuillez remplir tous les champs.";
    }
}

$listeClasses = getAllClasses() ?? [];
?>
<?php include ROOT . "/includes/header.php"; ?>
    
<h2>Gestion des Classes</h2>

<?php if (!empty($message)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>

<div class="row">
    <div class="col-md-5 mb-4">
        <div class="card p-4 shadow-sm">
            <h4 class="mb-3">Enregistrer une classe</h4>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Nom</label>
                    <input type="text" class="form-control" name="nom" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Année scolaire</label>
                    <input type="text" class="form-control" name="annee_scolaire" placeholder="Ex: 2026-2027" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Enregistrer</button>
            </form>
        </div>
    </div>

    <div class="col-md-7 mb-4">
        <h4 class="mb-3">Liste des Classes</h4>
        <?php if (!empty($listeClasses)): ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Année</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listeClasses as $classe): ?>
                            <tr>
                                <td><?= (int)$classe['id'] ?></td>
                                <td><strong><?= htmlspecialchars($classe['nom'] ?? '') ?></strong></td>
                                <td><?= htmlspecialchars($classe['annee_scolaire'] ?? '') ?></td>
                                <td class="text-center">
                                    <a href="classes.php?delete_id=<?= (int)$classe['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ?')">Supprimer</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-info">Aucune classe trouvée.</div>
        <?php endif; ?>
    </div>
</div>

<?php include ROOT . "/includes/footer.php"; ?>
