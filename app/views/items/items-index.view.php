<?php
view("parts/header", ['title' => 'items']);
view("parts/navigatie-menu");
?>
<div class="container mx-auto p-4">
    <h1 class="text-3xl my-4 font-bold text-center">Producten</h1>

    <!-- Zoekformulier -->
    <form method="GET" action="" class="mb-4 flex justify-start">
        <input type="text" name="search" placeholder="Zoek producten..." class="border p-1 rounded w-1/4" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
        <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded ml-2">Zoeken</button>
    </form>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <!-- loop door alle items heen -->
        <?php foreach ($items as $item) : ?>
        <?php if ($item['deleted_at'] === null): ?>
        <div class="mb-2 p-4 border rounded shadow-sm flex flex-col justify-between">
            <div>
                <a href="/items/items-show/<?= $item['id'] ?>">
                    <img src="/images/<?= htmlspecialchars($item['afbeelding']) ?>"
                        alt="<?= htmlspecialchars($item['naam']) ?>" class="w-full h-48 object-contain mb-2 rounded">
                </a>
                <a href="/items/items-show/<?= $item['id'] ?>" class="font-semibold">
                    <?= htmlspecialchars($item['naam']) ?>
                </a><br>
                <span class="text-gray-700"><?= htmlspecialchars($item['beschrijving']) ?></span><br>
                <span class="text-green-600 font-bold"><?= htmlspecialchars($item['prijs']) ?></span><br>
            </div>
            <!-- Add to cart form -->
            <form action="/cart/add" method="post" class="mt-2">
            <?= csrf() ?>
                <input type="hidden" name="id" value="<?= $item['id'] ?>">
                <button type="submit" class="bg-gray-500 text-white px-4 py-2 rounded">
                    <img src="/images/add-to-basket.png" alt="Add to Cart" class="inline-block w-6 h-6">
                </button>
            </form>
        </div>
        <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>

<?php
view("parts/footer");