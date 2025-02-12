<?php if ($total_pages > 1): ?>
    <div class="flex justify-center mt-4">
        <?php if ($current_page > 1): ?>
            <a href="?<?= http_build_query(array_merge($_GET, ['page' => $current_page - 1])) ?>" 
               class="px-3 py-1 mx-1 bg-gray-200 rounded hover:bg-gray-300">&laquo; Vorige</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <a href="?<?= http_build_query(array_merge($_GET, ['page' => $i])) ?>" 
               class="px-3 py-1 mx-1 <?= $i == $current_page ? 'bg-blue-500 text-white' : 'bg-gray-200' ?> rounded hover:bg-gray-300"><?= $i ?></a>
        <?php endfor; ?>

        <?php if ($current_page < $total_pages): ?>
            <a href="?<?= http_build_query(array_merge($_GET, ['page' => $current_page + 1])) ?>" 
               class="px-3 py-1 mx-1 bg-gray-200 rounded hover:bg-gray-300">Volgende &raquo;</a>
        <?php endif; ?>
    </div>
<?php endif; ?>
