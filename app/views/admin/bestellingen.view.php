<?php
view("parts/header", ["title" => "Bestellingen beheren"]);
view("parts/navigatie-menu");
?>

<div class="sm:mx-10">
    <h1 class="text-3xl my-4">Bestellingen beheren</h1>
</div>

<div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <table class="border border-slate-400 dark:border-slate-300 mt-6 w-full">
        <thead>
            <tr>
                <th class="font-bold text-left p-2">Bestelling ID</th>
                <th class="font-bold text-left p-2">Klant ID</th>
                <th class="font-bold text-left p-2">Producten</th>
                <th class="font-bold text-left p-2">Prijzen</th>
                <th class="font-bold text-left p-2">Status</th>
                <th class="font-bold text-left p-2">Acties</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bestellingen as $bestelling): ?>
                <tr class="bg-slate-200 hover:bg-slate-400 border border-slate-300">
                    <td class="p-4"><?= htmlspecialchars($bestelling['id']) ?></td>
                    <td class="p-4"><?= htmlspecialchars($bestelling['klant_id']) ?></td>
                    <td class="p-4"><?= htmlspecialchars(implode(', ', $bestelling['product_ids'] ?? [])) ?></td>
                    <td class="p-4"><?= htmlspecialchars(implode(', ', $bestelling['prijzen'] ?? [])) ?></td>
                    <td class="p-4"><?= htmlspecialchars($bestelling['deleted_at'] ? 'verwijderd' : $bestelling['status']) ?></td>
                    <td class="p-4">
                        <a href="/admin/bestellingen-edit?id=<?= $bestelling['id'] ?>" class="bg-indigo-600 text-white py-1 px-3 rounded-md hover:bg-indigo-700">Wijzigen</a>
                        <?php if (!$bestelling['deleted_at']): ?>
                            <form action="/admin/bestellingen-delete" method="post" style="display:inline;">
                            <?= csrf() ?>
                                <input type="hidden" name="id" value="<?= $bestelling['id'] ?>">
                                <button type="submit" class="bg-red-600 text-white py-1 px-3 rounded-md hover:bg-red-700">Verwijderen</button>
                            </form>
                        <?php else: ?>
                            <form action="/admin/bestellingen-restore" method="post" style="display:inline;">
                                <?= csrf() ?>
                                <input type="hidden" name="id" value="<?= $bestelling['id'] ?>">
                                <button type="submit" class="bg-green-600 text-white py-1 px-3 rounded-md hover:bg-green-700">Herstellen</button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php
view("parts/footer");
?>
