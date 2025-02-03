<?php
view("parts/header", ['title' => 'items']);
view("parts/navigatie-menu");
?>
<div class="container mx-auto p-4">
    <h1 class="text-3xl my-4 font-bold text-center">Producten</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <!-- loop door alle items heen -->
        <?php foreach ($items as $item) : ?>
        <?php if ($item['deleted_at'] === null): ?>
        <div class="mb-2 p-4 border rounded shadow-sm">
            <img src="/images/<?= htmlspecialchars($item['afbeelding']) ?>"
                alt="<?= htmlspecialchars($item['naam']) ?>" class="w-full h-48 object-contain mb-2 rounded">
            <span class="font-semibold"><?= $item['id'] ?> - <?= htmlspecialchars($item['naam']) ?></span><br>
            <span class="text-gray-700"><?= htmlspecialchars($item['beschrijving']) ?></span><br>
            <span class="text-green-600 font-bold"><?= htmlspecialchars($item['prijs']) ?></span><br>
            <a href="/items/items-show/<?= $item['id'] ?>"
                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Link naar item</a>
            <!-- Add to cart form -->
            <form action="/cart/add" method="post" class="mt-2">
            <?= csrf() ?>
                <input type="hidden" name="id" value="<?= $item['id'] ?>">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add to Cart</button>
            </form>
        </div>
        <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>

<?php
view("parts/footer");