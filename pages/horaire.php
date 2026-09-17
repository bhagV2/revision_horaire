<?php
/**
 * Page d'affichage des horaires
 * @author M.Bhagya
 */
define('ROOT', '..');
require_once ROOT . '/functions/classes.php';
require_once ROOT . '/functions/cours.php';
require_once ROOT . '/functions/creneaux.php';

$message = "";

$delete_id = filter_input(INPUT_GET, 'delete_id', FILTER_VALIDATE_INT);
$classe_get = filter_input(INPUT_GET, 'classe', FILTER_SANITIZE_SPECIAL_CHARS);

if ($delete_id) {
    deleteCreneau($delete_id);
    header("Location: horaire.php?classe=" . $classe_get);
    exit();
}

$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'POST') {
    $classe_id = filter_input(INPUT_POST, 'classe_id', FILTER_VALIDATE_INT);
    $cours_id = filter_input(INPUT_POST, 'cours_id', FILTER_VALIDATE_INT);
    $jour = filter_input(INPUT_POST, 'jour', FILTER_SANITIZE_SPECIAL_CHARS);
    $heure_debut = filter_input(INPUT_POST, 'heure_debut', FILTER_SANITIZE_SPECIAL_CHARS);
    $heure_fin = filter_input(INPUT_POST, 'heure_fin', FILTER_SANITIZE_SPECIAL_CHARS);
    $salle = filter_input(INPUT_POST, 'salle', FILTER_SANITIZE_SPECIAL_CHARS);

    if ($classe_id && $cours_id && !empty($jour) && !empty($heure_debut) && !empty($heure_fin) && !empty($salle)) {
        addCreneau($classe_id, $cours_id, $jour, $heure_debut, $heure_fin, $salle);
        header("Location: horaire.php?classe=" . $classe_get);
        exit();
    } else {
        $message = "Veuillez remplir tous les champs.";
    }
}

$lesClasses = getAllClasses() ?? [];
$lesCours = getAllCours() ?? [];

$classeSelectionnee = !empty($classe_get) ? trim($classe_get) : '';
$planning = [];

if (!empty($classeSelectionnee)) {
    $planning = getAllCreneauxByClasse($classeSelectionnee) ?? [];
}
?>
<?php include ROOT . "/includes/header.php"; ?>

<h2>Consulter un Horaire</h2>

<?php if (!empty($message)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>

<form method="GET" action="horaire.php" class="mb-4">
    <select class="form-select" name="classe" required>
        <option value="">-- Sélectionner une classe --</option>
        <?php foreach ($lesClasses as $c): ?>
            <option value="<?= htmlspecialchars($c['nom']) ?>" <?= $classeSelectionnee === $c['nom'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($c['nom']) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <button type="submit" class="btn btn-primary mt-2">Afficher</button>
</form>

<?php if (!empty($classeSelectionnee)): ?>
    <hr>
    <h4>Emploi du temps : <?= htmlspecialchars($classeSelectionnee) ?></h4>
    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Jour</th>
                    <th>Début</th>
                    <th>Fin</th>
                    <th>Cours</th>
                    <th>Code</th>
                    <th>Salle</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($planning)): ?>
                    <tr>
                        <td colspan="7">Aucun cours planifié pour cette classe.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($planning as $creneau): ?>
                        <tr>
                            <td class="text-capitalize"><?= htmlspecialchars($creneau['jour']) ?></td>
                            <td><?= htmlspecialchars(substr($creneau['heure_debut'], 0, 5)) ?></td>
                            <td><?= htmlspecialchars(substr($creneau['heure_fin'], 0, 5)) ?></td>
                            <td><?= htmlspecialchars($creneau['cours']) ?></td>
                            <td><?= htmlspecialchars($creneau['code_cours']) ?></td>
                            <td><?= htmlspecialchars($creneau['salle']) ?></td>
                            <td class="text-center">
                                <a href="horaire.php?classe=<?= $classeSelectionnee ?>&delete_id=<?= (int)$creneau['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ?')">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<hr>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card p-4 shadow-sm">
            <h4 class="mb-3">Assigner un Créneau</h4>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Classe</label>
                    <select class="form-select" name="classe_id" required>
                        <option value="">-- Choisir --</option>
                        <?php foreach ($lesClasses as $c): ?>
                            <option value="<?= (int)$c['id'] ?>"><?= htmlspecialchars($c['nom']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Cours</label>
                    <select class="form-select" name="cours_id" required>
                        <option value="">-- Choisir --</option>
                        <?php foreach ($lesCours as $co): ?>
                            <option value="<?= (int)$co['id'] ?>">[<?= htmlspecialchars($co['code']) ?>] <?= htmlspecialchars($co['nom']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jour</label>
                    <select class="form-select" name="jour" required>
                        <option value="lundi">Lundi</option>
                        <option value="mardi">Mardi</option>
                        <option value="mercredi">Mercredi</option>
                        <option value="jeudi">Jeudi</option>
                        <option value="vendredi">Vendredi</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Début</label>
                    <input type="time" class="form-control" name="heure_debut" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Fin</label>
                    <input type="time" class="form-control" name="heure_fin" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Salle</label>
                    <input type="text" class="form-control" name="salle" required>
                </div>

                <button type="submit" class="btn btn-success w-100">Planifier</button>
            </form>
        </div>
    </div>
</div>

<?php include ROOT . "/includes/footer.php"; ?>
