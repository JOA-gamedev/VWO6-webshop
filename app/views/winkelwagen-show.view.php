<?php
view("parts/header", ['title' => 'Winkelwagen']);
view("parts/navigatie-menu");
?>
<div class="container mx-auto p-4">
<a href="/items/items-index" class="bg-gray-500 text-white px-2 py-1 rounded">Terug</a>
    <h1 class="text-3xl my-4 font-bold text-center">Winkelwagen</h1>
    <?php if (!empty($producten)): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <?php foreach ($producten as $product): ?>
                <div class="mb-2 p-4 border rounded shadow-sm flex flex-col justify-between">
                    <div>
                        <img src="/images/<?= htmlspecialchars($product['afbeelding']) ?>"
                            alt="<?= htmlspecialchars($product['naam']) ?>" class="w-full h-48 object-contain mb-2 rounded">
                        <span class="font-semibold"><?= htmlspecialchars($product['naam']) ?></span><br>
                        <span class="text-gray-700"><?= htmlspecialchars($product['beschrijving']) ?></span><br>
                        <span class="text-green-600 font-bold">Prijs:
                            €<?= number_format($product['prijs'], 2, ',', '.') ?></span><br>
                        <form action="/cart/update" method="post" class="mt-2 update-cart-form">
                            <?= csrf() ?>
                            <input type="hidden" name="id" value="<?= $product['id'] ?>">
                            <input type="hidden" name="old_size" value="<?= $product['maat'] ?>">
                            <label for="size-<?= $product['id'] ?>" class="block text-sm font-medium text-gray-700">Maat:</label>
                            <select id="size-<?= $product['id'] ?>" name="size" class="border border-gray-300 rounded-md mb-2 update-cart">
                                <option value="xs" <?= $product['maat'] == 'xs' ? 'selected' : '' ?>>XS</option>
                                <option value="s" <?= $product['maat'] == 's' ? 'selected' : '' ?>>S</option>
                                <option value="m" <?= $product['maat'] == 'm' ? 'selected' : '' ?>>M</option>
                                <option value="l" <?= $product['maat'] == 'l' ? 'selected' : '' ?>>L</option>
                                <option value="xl" <?= $product['maat'] == 'xl' ? 'selected' : '' ?>>XL</option>
                            </select>
                            <label for="quantity-<?= $product['id'] ?>" class="block text-sm font-medium text-gray-700">Aantal:</label>
                            <input type="number" id="quantity-<?= $product['id'] ?>" name="quantity" value="<?= $product['aantal'] ?>" min="1" class="border border-gray-300 rounded-md mb-2 update-cart">
                        </form>
                        <span class="text-gray-900 font-bold">Totaal:
                            €<?= number_format($product['totaal'], 2, ',', '.') ?></span><br>
                    </div>
                    <form action="/cart/remove" method="post" class="mt-2">
                        <?= csrf() ?>
                        <input type="hidden" name="id" value="<?= $product['id'] ?>">
                        <input type="hidden" name="size" value="<?= $product['maat'] ?>">
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Verwijderen</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="text-right mt-4">
            <span class="text-xl font-bold">Totaal: €<?= $totaal ?></span><br>
            <?php if (!isset($_SESSION['user'])): ?>
                <a href="/checkout/login-required" class="inline-block bg-green-500 text-white px-4 py-2 rounded">Afrekenen</a>
            <?php else: ?>
                <a href="/checkout" class="inline-block bg-green-500 text-white px-4 py-2 rounded">Afrekenen</a>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <p class="text-center text-red-500">Uw winkelwagen is leeg.</p>
    <?php endif; ?>
</div>
<script>
    document.querySelectorAll('.update-cart').forEach(element => {
        element.addEventListener('change', function() {
            this.closest('form').submit();
        });
    });
</script>
<?php
view("parts/footer");
?>