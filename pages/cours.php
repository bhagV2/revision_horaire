<?php
/**
 * Page de gestion des cours
 * @author M.Bhagya
 */
define('ROOT', '..');
require_once ROOT . '/functions/classes.php';
require_once ROOT . '/functions/cours.php';

$message = "";

$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'POST') {
    $code = filter_input(INPUT_POST, 'code', FILTER_SANITIZE_SPECIAL_CHARS);
    $nom  = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_SPECIAL_CHARS);

    if (!empty($code) && !empty($nom)) {
        addCours(trim($code), trim($nom));
        header("Location: cours.php");
        exit();
    } else {
        $message = "Veuillez remplir tous les champs.";
    }
}

$lesClasses = getAllClasses() ?? [];
$lesCours = getAllCours() ?? [];
?>
<?php include ROOT . "/includes/header.php"; ?>

<h2>Gestion des Cours</h2>

<?php if (!empty($message)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>

<div class="row">
    <div class="col-md-5 mb-4">
        <div class="card p-4 shadow-sm">
            <h4 class="mb-3">Créer un Cours</h4>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Code</label>
                    <input type="text" class="form-control" name="code" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nom</label>
                    <input type="text" class="form-control" name="nom" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Ajouter</button>
            </form>
        </div>
    </div>

    <div class="col-md-7 mb-4">
        <h4 class="mb-3">Liste des Cours</h4>
        <?php if (!empty($lesCours)): ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Code</th>
                            <th>Nom du cours</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lesCours as $cours): ?>
                            <tr>
                                <td><strong><?= htmlspecialchars($cours['code'] ?? '') ?></strong></td>
                                <td><?= htmlspecialchars($cours['nom'] ?? '') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-info">Aucun cours trouvé.</div>
        <?php endif; ?>
    </div>
</div>

<?php include ROOT . "/includes/footer.php"; ?>
