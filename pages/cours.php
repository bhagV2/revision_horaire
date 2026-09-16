<?php
/**
 * Interface de gestion des cours et creneaux
 * @author M.Bhagya
 */
$api_url = "http://" . $_SERVER['HTTP_HOST'] . str_replace('/pages/cours.php', '/api/index.php', $_SERVER['SCRIPT_NAME']);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action_cours'])) {
    $options = [
        'http' => [
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($_POST)
        ]
    ];
    file_get_contents($api_url . "?route=cours&action=add_cours", false, stream_context_create($options));
    header("Location: cours.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action_creneau'])) {
    $options = [
        'http' => [
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($_POST)
        ]
    ];
    file_get_contents($api_url . "?route=cours&action=add_creneau", false, stream_context_create($options));
    header("Location: cours.php");
    exit;
}

$jsonClasses = file_get_contents($api_url . "?route=classes");
$lesClasses = json_decode($jsonClasses, true) ?? [];

$jsonCours = file_get_contents($api_url . "?route=cours");
$lesCours = json_decode($jsonCours, true) ?? [];
?>
<?php include("../includes/header.php"); ?>

<h2>Gestion des Cours et Créneaux</h2>

<h4>Créer un Cours</h4>
<form method="POST" class="mb-4">
    <input type="hidden" name="action_cours" value="1">
    <label class="form-label">Code</label>
    <input type="text" class="form-control" name="code" required>
    <label class="form-label">Nom</label>
    <input type="text" class="form-control" name="nom" required>
    <button type="submit" class="btn btn-primary mt-2">Ajouter</button>
</form>

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
