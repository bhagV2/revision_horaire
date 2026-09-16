<?php
/**
 * Pied de page
 * @author M.Bhagya
 */
$root = str_replace('/includes', '', dirname($_SERVER['SCRIPT_NAME']));
?>
</main>
<footer class="text-center py-4 mt-5 border-top text-muted">
    <p>© <?= date('Y') ?> - CFPT - M.Bhagya</p>
</footer>
<script src="<?= $root ?>/bootstrap.bundle.min.js"></script>
</body>
</html>
