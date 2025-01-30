<?php
view("parts/header", ['title' => 'Afrekenen']);
view("parts/navigatie-menu");
?>
<div class="container mx-auto p-4">
    <h1 class="text-3xl my-4 font-bold text-center">Afrekenen</h1>
    <?php if (!empty($producten)): ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <?php foreach ($producten as $product): ?>
        <div class="mb-2 p-4 border rounded shadow-sm">
            <img src="/images/<?= htmlspecialchars($product['afbeelding'] ?? '') ?>"
                alt="<?= htmlspecialchars($product['naam'] ?? '') ?>" class="w-full h-48 object-cover mb-2 rounded">
            <span class="font-semibold"><?= htmlspecialchars($product['naam'] ?? '') ?></span><br>
            <span class="text-gray-700"><?= htmlspecialchars($product['beschrijving'] ?? '') ?></span><br>
            <span class="text-green-600 font-bold">Prijs: €<?= number_format($product['prijs'] ?? 0, 2, ',', '.') ?></span><br>
            <span class="text-gray-700">Aantal: <?= $product['aantal'] ?? 0 ?></span><br>
            <span class="text-gray-900 font-bold">Totaal: €<?= number_format($product['totaal'] ?? 0, 2, ',', '.') ?></span><br>
        </div>
        <?php endforeach; ?>
    </div>
    <div class="mt-4">
        <h2 class="text-2xl font-bold">Verzendinformatie</h2>
        <form action="/checkout/process" method="post" class="mt-4">
            <?= csrf() ?>
            <div class="mb-4">
                <label for="naam" class="block text-gray-700">Naam:</label>
                <input type="text" id="naam" name="naam" class="w-full p-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="straat" class="block text-gray-700">Straat:</label>
                <input type="text" id="straat" name="straat" class="w-full p-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="huisnummer" class="block text-gray-700">Huisnummer:</label>
                <input type="text" id="huisnummer" name="huisnummer" class="w-full p-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="postcode" class="block text-gray-700">Postcode:</label>
                <input type="text" id="postcode" name="postcode" class="w-full p-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="plaats" class="block text-gray-700">Plaats:</label>
                <input type="text" id="plaats" name="plaats" class="w-full p-2 border rounded" required>
            </div>
            <h2 class="text-2xl font-bold mt-4">Betalingsinformatie</h2>
            <div class="mb-4">
                <label for="kaartnummer" class="block text-gray-700">Kaartnummer:</label>
                <input type="text" id="kaartnummer" name="kaartnummer" class="w-full p-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="vervaldatum" class="block text-gray-700">Vervaldatum:</label>
                <input type="text" id="vervaldatum" name="vervaldatum" class="w-full p-2 border rounded" placeholder="MM/YY" required>
            </div>
            <div class="mb-4">
                <label for="cvv" class="block text-gray-700">CVV:</label>
                <input type="text" id="cvv" name="cvv" class="w-full p-2 border rounded" required>
            </div>
            <div class="text-right">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Bestelling plaatsen</button>
            </div>
        </form>
    </div>
    <?php else: ?>
    <p class="text-center text-red-500">Uw winkelwagen is leeg.</p>
    <?php endif; ?>
</div>
<?php
view("parts/footer");
