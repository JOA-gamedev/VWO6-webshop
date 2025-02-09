<!-- home.php -->
<?php
view("parts/header", ['title' => 'Home']); // Laad de header
view("parts/navigatie-menu"); // Laad het navigatiemenu
?>

<div class="sm:mx-10">
    <div class="bg-cover bg-center h-64 text-black flex items-center justify-center" style="background-image: url('/images/eyecatcher.jpg');">
        <h1 class="text-4xl font-bold">Welkom bij onze Kledingwinkel</h1>
    </div>

    <h2 class="text-3xl my-4">Uitgelichte Producten</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <?php foreach ($items as $item) : ?>
            <?php if ($item['deleted_at'] === null): ?>
                <div class="mb-2 p-4 border rounded shadow-sm flex flex-col justify-between">
                    <div>
                        <a href="/items/items-show/<?= htmlspecialchars($item['id']) ?>">
                            <img src="/images/<?= htmlspecialchars($item['afbeelding']) ?>" alt="<?= htmlspecialchars($item['naam']) ?>" class="w-full h-48 object-contain mb-2 rounded">
                        </a>
                        <a href="/items/items-show/<?= htmlspecialchars($item['id']) ?>" class="font-semibold">
                            <?= htmlspecialchars($item['naam']) ?>
                        </a><br>
                        <span class="text-gray-700"><?= htmlspecialchars($item['beschrijving']) ?></span><br>
                        <span class="text-gray-700">Kleur: <?= htmlspecialchars($item['kleur'] ?? '-') ?></span><br>
                        <span class="text-gray-700">Geslacht: <?= htmlspecialchars($item['geslacht'] ?? '-') ?></span><br>
                        <span class="text-green-600 font-bold"><?= htmlspecialchars($item['prijs']) ?></span><br>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>

<?php
view("parts/footer"); // Laad de footer (sluit body en html correct af)
?>
