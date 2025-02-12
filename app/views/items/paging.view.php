<?php if ($total_pages > 1): ?>
    <div class="pagination">
        <?php if ($current_page > 1): ?>
            <a href="?<?= http_build_query(array_merge($_GET, ['page' => $current_page - 1])) ?>">&laquo; Vorige</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <a href="?<?= http_build_query(array_merge($_GET, ['page' => $i])) ?>" 
               class="<?= $i == $current_page ? 'active' : '' ?>"><?= $i ?></a>
        <?php endfor; ?>

        <?php if ($current_page < $total_pages): ?>
            <a href="?<?= http_build_query(array_merge($_GET, ['page' => $current_page + 1])) ?>">Volgende &raquo;</a>
        <?php endif; ?>
    </div>
<?php endif; ?>
