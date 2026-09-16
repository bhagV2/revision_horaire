<?php
/**
 * Interface des classes
 * @author M.Bhagya
 */
$api_url = "http://" . $_SERVER['HTTP_HOST'] . str_replace('/pages/classes.php', '/api/index.php', $_SERVER['SCRIPT_NAME']);

if (isset($_GET['delete_id'])) {
    $options = [
        'http' => [
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query(['id' => $_GET['delete_id']])
        ]
    ];
    file_get_contents($api_url . "?route=classes&action=delete_classe", false, stream_context_create($options));
    header("Location: classes.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $options = [
        'http' => [
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($_POST)
        ]
    ];
    file_get_contents($api_url . "?route=classes&action=add_classe", false, stream_context_create($options));
    header("Location: classes.php");
    exit;
}

$json = file_get_contents($api_url . "?route=classes");
$listeClasses = json_decode($json, true) ?? [];
?>

<?php include("../includes/header.php"); ?>
    
<h2>Gestion des Classes</h2>

<form method="POST" class="mb-4">
    <label class="form-label">Nom</label>
    <input type="text" class="form-control" name="nom" required>
    
    <label class="form-label">Année scolaire</label>
    <input type="text" class="form-control" name="annee_scolaire" required>
    
    <button type="submit" class="btn btn-primary mt-2">Enregistrer</button>
</form>

<hr>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Année</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($listeClasses as $classe): ?>
            <tr>
                <td><?= $classe['id'] ?></td>
                <td><strong><?= htmlspecialchars($classe['nom']) ?></strong></td>
                <td><?= htmlspecialchars($classe['annee_scolaire']) ?></td>
                <td>
                    <a href="classes.php?delete_id=<?= $classe['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ?')">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include("../includes/footer.php"); ?>
