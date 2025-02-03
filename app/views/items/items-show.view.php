<?php
view("parts/header", ['title' => $item['id']]);
view("parts/navigatie-menu");
?>
<?php if ($item['deleted_at'] === null): ?>
    <div class="container mx-auto p-4">
        <!-- Back to products button -->
        <a href="/items/items-index" class="bg-gray-500 text-white px-4 py-2 rounded mb-2 inline-block">Terug</a>
        <h1 class="text-3xl my-4 font-bold text-center"><?= htmlspecialchars($item['naam']) ?></h1>
        <div class="flex flex-col md:flex-row items-center md:items-start">
            <img src="/images/<?= htmlspecialchars($item['afbeelding']) ?>" alt="<?= htmlspecialchars($item['naam']) ?>" class="w-full md:w-1/2 h-64 object-contain mb-4 md:mb-0 md:mr-4 rounded">
            <div class="md:w-1/2">
                naam: <?= htmlspecialchars($item['naam']) ?><br>
                beschrijving: <?= htmlspecialchars($item['beschrijving']) ?><br>
                prijs: <?= $item['prijs']; ?><br>
                <!-- Add to cart form -->
                <form action="/cart/add" method="post" class="mt-2">
                <?= csrf() ?>
                    <input type="hidden" name="id" value="<?= $item['id'] ?>">
                    <button type="submit" class="bg-gray-500 text-white px-4 py-2 rounded">
                        <img src="/images/add-to-basket.png" alt="Add to Cart" class="inline-block w-6 h-6">
                    </button>
                </form>
            </div>
        </div>
    </div>
<?php else: ?>
    <p class="text-red-500">This item has been deleted.</p>
<?php endif; ?>
<?php
view("parts/footer");
?>