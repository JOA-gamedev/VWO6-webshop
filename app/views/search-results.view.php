<?php
view("parts/header", ['title' => 'Zoekresultaten']);
view("parts/navigatie-menu");
?>
<div class="container mx-auto p-4">
    <h1 class="text-3xl my-4 font-bold text-center">Zoekresultaten voor "<?= htmlspecialchars($query) ?>"</h1>
    <?php if (empty($items)) : ?>
        <p class="text-center text-red-500">Geen producten gevonden die overeenkomen met uw zoekopdracht.</p>
    <?php else : ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- loop door alle items heen -->
            <?php foreach ($items as $item) : ?>
                <?php if ($item['deleted_at'] === null): ?>
                    <div class="mb-2 p-4 border rounded shadow-sm flex flex-col justify-between">
                        <div>
                            <a href="/items/items-show/<?= htmlspecialchars($item['id']) ?>">
                                <img src="/images/<?= htmlspecialchars($item['afbeelding']) ?>"
                                    alt="<?= htmlspecialchars($item['naam']) ?>"
                                    class="w-full h-48 object-contain mb-2 rounded">
                            </a>
                            <a href="/items/items-show/<?= htmlspecialchars($item['id']) ?>" class="font-semibold">
                                <?= htmlspecialchars($item['naam']) ?>
                            </a><br>
                            <span class="text-gray-700"><?= htmlspecialchars($item['beschrijving']) ?></span><br>
                            <span class="text-gray-700">Kleur: <?= htmlspecialchars($item['kleur'] ?? '-') ?></span><br>
                            <span class="text-gray-700">Geslacht: <?= htmlspecialchars($item['geslacht'] ?? '-') ?></span><br>
                            <span class="text-green-600 font-bold">€<?= htmlspecialchars($item['prijs']) ?></span><br>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
<?php
view("parts/footer");
?>
