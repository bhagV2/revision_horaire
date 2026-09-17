<?php
/**
 * Consultation d'horaire
 * @author M.Bhagya
 */

$api_url = "http://" . $_SERVER['HTTP_HOST'] . str_replace('/pages/horaire.php', '/api/index.php', $_SERVER['SCRIPT_NAME']);

if (isset($_GET['delete_id'])) {
    $options = [
        'http' => [
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query(['id' => $_GET['delete_id']])
        ]
    ];
    file_get_contents($api_url . "?route=cours&action=delete_creneau", false, stream_context_create($options));
    header("Location: horaire.php?classe=" . urlencode($_GET['classe']));
    exit;
}

$jsonClasses = file_get_contents($api_url . "?route=classes");
$lesClasses = json_decode($jsonClasses, true) ?? [];

$classeSelectionnee = isset($_GET['classe']) ? trim($_GET['classe']) : '';
$planning = [];

if (!empty($classeSelectionnee)) {
    $jsonPlanning = file_get_contents($api_url . "?route=cours&classe=" . urlencode($classeSelectionnee));
    $planning = json_decode($jsonPlanning, true) ?? [];
}
?>

<?php include("../includes/header.php"); ?>

<h2>Consulter un Horaire</h2>

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
    <table class="table">
        <thead>
            <tr>
                <th>Jour</th>
                <th>Début</th>
                <th>Fin</th>
                <th>Cours</th>
                <th>Code</th>
                <th>Salle</th>
                <th>Action</th>
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
                        <td>
                            <a href="horaire.php?classe=<?= urlencode($classeSelectionnee) ?>&delete_id=<?= $creneau['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ?')">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
<?php endif; ?>

<hr>

<h4>Assigner un Créneau</h4>
<form method="POST">
    <input type="hidden" name="action_creneau" value="1">
    
    <label class="form-label">Classe</label>
    <select class="form-select" name="classe_id" required>
        <option value="">-- Choisir --</option>
        <?php foreach ($lesClasses as $c): ?>
            <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['nom']) ?></option>
        <?php endforeach; ?>
    </select>

    <label class="form-label">Cours</label>
    <select class="form-select" name="cours_id" required>
        <option value="">-- Choisir --</option>
        <?php foreach ($lesCours as $co): ?>
            <option value="<?= $co['id'] ?>">[<?= htmlspecialchars($co['code']) ?>] <?= htmlspecialchars($co['nom']) ?></option>
        <?php endforeach; ?>
    </select>

    <label class="form-label">Jour</label>
    <select class="form-select" name="jour" required>
        <option value="lundi">Lundi</option>
        <option value="mardi">Mardi</option>
        <option value="mercredi">Mercredi</option>
        <option value="jeudi">Jeudi</option>
        <option value="vendredi">Vendredi</option>
    </select>

    <label class="form-label">Début</label>
    <input type="time" class="form-control" name="heure_debut" required>

    <label class="form-label">Fin</label>
    <input type="time" class="form-control" name="heure_fin" required>

    <label class="form-label">Salle</label>
    <input type="text" class="form-control" name="salle" required>

    <button type="submit" class="btn btn-success mt-2">Planifier</button>
</form>

<?php include("../includes/footer.php"); ?>
