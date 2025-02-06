<?php
view("parts/header", ['title' => $item['id']]);
view("parts/navigatie-menu");
?>
<?php if ($item['deleted_at'] === null): ?>
    <div class="container mx-auto p-4">
        <!-- Back to products button -->
        <a href="<?= isset($_GET['from']) && $_GET['from'] === 'bestel-status' ? '/bestel-status' : '/items/items-index' ?>" class="bg-gray-500 text-white px-4 py-2 rounded mb-2 inline-block">Terug</a>
        <h1 class="text-3xl my-4 font-bold text-center"><?= htmlspecialchars($item['naam']) ?></h1>
        <div class="flex flex-col md:flex-row items-center md:items-start">
            <img src="/images/<?= htmlspecialchars($item['afbeelding']) ?>" alt="<?= htmlspecialchars($item['naam']) ?>" class="w-full md:w-1/2 h-64 object-contain mb-4 md:mb-0 md:mr-4 rounded">
            <div class="md:w-1/2">
                <p class="text-lg text-gray-700"><strong>Naam:</strong> <?= htmlspecialchars($item['naam']) ?></p>
                <p class="text-lg text-gray-700"><strong>Beschrijving:</strong> <?= htmlspecialchars($item['beschrijving']) ?></p>
                <p class="text-lg text-gray-700"><strong>Kleur:</strong> <?= htmlspecialchars($item['kleur'] ?? '-') ?></p>
                <p class="text-lg text-gray-700"><strong>Geslacht:</strong> <?= htmlspecialchars($item['geslacht'] ?? '-') ?></p>
                <p class="text-lg text-gray-700"><strong>Prijs:</strong> &euro;<?= number_format((float)$item['prijs'], 2, ',', '.') ?></p>
                <label for="size" class="block text-sm font-medium text-gray-700">Maat:</label>
                <select id="size" name="size" class="border border-gray-300 rounded-md">
                    <option value="">Kies uw maat</option>
                    <option value="xs">XS</option>
                    <option value="s">S</option>
                    <option value="m">M</option>
                    <option value="l">L</option>
                    <option value="xl">XL</option>
                </select>
                <!-- Add to cart form -->
                <form id="addToCartForm" action="/cart/add" method="post" class="mt-2">
                <?= csrf() ?>
                    <input type="hidden" name="id" value="<?= $item['id'] ?>">
                    <input type="hidden" name="size" id="selectedSize">
                    <input type="hidden" name="color" value="<?= htmlspecialchars($item['kleur'] ?? '-') ?>">
                    <input type="hidden" name="gender" value="<?= htmlspecialchars($item['geslacht'] ?? '-') ?>">
                    <button type="submit" class="bg-gray-500 text-white px-4 py-2 rounded">
                        <img src="/images/add-to-basket.png" alt="Add to Cart" class="inline-block w-6 h-6">
                    </button>
                </form>
                <p id="sizeError" class="text-red-500 hidden">Kies een maat</p>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('addToCartForm').addEventListener('submit', function(event) {
            const size = document.getElementById('size').value;
            let hasError = false;
            if (!size) {
                event.preventDefault();
                document.getElementById('sizeError').classList.remove('hidden');
                hasError = true;
            } else {
                document.getElementById('selectedSize').value = size;
                document.getElementById('sizeError').classList.add('hidden');
            }
            if (hasError) {
                event.preventDefault();
            }
        });
    </script>
<?php else: ?>
    <p class="text-red-500">This item has been deleted.</p>
<?php endif; ?>
<?php
view("parts/footer");
?>