<?php
view("parts/header", ['title' => 'Winkelwagen']);
view("parts/navigatie-menu");
?>
<div class="container mx-auto p-4">
    <h1 class="text-3xl my-4 font-bold text-center">Winkelwagen</h1>
    <?php if (!empty($producten)): ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <?php foreach ($producten as $product): ?>
        <div class="mb-2 p-4 border rounded shadow-sm">
            <img src="/images/<?= htmlspecialchars($product['afbeelding']) ?>"
                alt="<?= htmlspecialchars($product['naam']) ?>" class="w-full h-48 object-contain mb-2 rounded">
            <span class="font-semibold"><?= htmlspecialchars($product['naam']) ?></span><br>
            <span class="text-gray-700"><?= htmlspecialchars($product['beschrijving']) ?></span><br>
            <span class="text-green-600 font-bold">Prijs: €<?= number_format($product['prijs'], 2, ',', '.') ?></span><br>
            <span class="text-gray-700">Aantal: <?= $product['aantal'] ?></span><br>
            <span class="text-gray-900 font-bold">Totaal: €<?= number_format($product['totaal'], 2, ',', '.') ?></span><br>
            <form action="/cart/remove" method="post" class="mt-2">
                <?= csrf() ?>
                <input type="hidden" name="id" value="<?= $product['id'] ?>">
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Verwijderen</button>
            </form>
        </div>
        <?php endforeach; ?>
    </div>
    <div class="text-right mt-4">
        <span class="text-xl font-bold">Totaal: €<?= $totaal ?></span>
        <form action="/checkout" method="get" class="mt-2">
            <?= csrf() ?>
            <?php foreach ($producten as $product): ?>
                <input type="hidden" name="producten[<?= $product['id'] ?>][id]" value="<?= $product['id'] ?>">
                <input type="hidden" name="producten[<?= $product['id'] ?>][naam]" value="<?= htmlspecialchars($product['naam']) ?>">
                <input type="hidden" name="producten[<?= $product['id'] ?>][beschrijving]" value="<?= htmlspecialchars($product['beschrijving']) ?>">
                <input type="hidden" name="producten[<?= $product['id'] ?>][prijs]" value="<?= $product['prijs'] ?>">
                <input type="hidden" name="producten[<?= $product['id'] ?>][aantal]" value="<?= $product['aantal'] ?>">
                <input type="hidden" name="producten[<?= $product['id'] ?>][totaal]" value="<?= $product['totaal'] ?>">
            <?php endforeach; ?>
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Afrekenen</button>
        </form>
    </div>
    <?php else: ?>
    <p class="text-center text-red-500">Uw winkelwagen is leeg.</p>
    <?php endif; ?>
</div>
<?php
view("parts/footer");
?>
