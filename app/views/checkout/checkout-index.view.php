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
                <label for="naam" class="block text-sm font-medium text-gray-700">Naam:</label>
                <input type="text" id="naam" name="naam" value="<?= htmlspecialchars($profile['naam'] ?? '') ?>" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div class="mb-4">
                <label for="straat" class="block text-sm font-medium text-gray-700">Straat:</label>
                <input type="text" id="straat" name="straat" value="<?= htmlspecialchars($profile['straat'] ?? '') ?>" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div class="mb-4">
                <label for="huisnummer" class="block text-sm font-medium text-gray-700">Huisnummer:</label>
                <input type="text" id="huisnummer" name="huisnummer" value="<?= htmlspecialchars($profile['huisnummer'] ?? '') ?>" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div class="mb-4">
                <label for="postcode" class="block text-sm font-medium text-gray-700">Postcode:</label>
                <input type="text" id="postcode" name="postcode" value="<?= htmlspecialchars($profile['postcode'] ?? '') ?>" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div class="mb-4">
                <label for="plaats" class="block text-sm font-medium text-gray-700">Plaats:</label>
                <input type="text" id="plaats" name="plaats" value="<?= htmlspecialchars($profile['plaats'] ?? '') ?>" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <h2 class="text-2xl font-bold mt-4">Betalingsinformatie</h2>
            <div class="mb-4">
                <label for="kaartnummer" class="block text-sm font-medium text-gray-700">Kaartnummer:</label>
                <input type="text" id="kaartnummer" name="kaartnummer" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>
            <div class="mb-4">
                <label for="vervaldatum" class="block text-sm font-medium text-gray-700">Vervaldatum:</label>
                <input type="text" id="vervaldatum" name="vervaldatum" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="MM/YY" required>
            </div>
            <div class="mb-4">
                <label for="cvv" class="block text-sm font-medium text-gray-700">CVV:</label>
                <input type="text" id="cvv" name="cvv" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>
            <h2 class="text-2xl font-bold mt-4">Kortingscode</h2>
            <div class="mb-4">
                <label for="kortingscode" class="block text-sm font-medium text-gray-700">Kortingscode:</label>
                <div class="flex items-center">
                    <input type="text" id="kortingscode" name="kortingscode" class="mt-1 block w-1/7 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <button type="button" class="ml-2 bg-blue-500 text-white px-2 py-1 rounded" onclick="applyDiscount()">Toevoegen</button>
                </div>
            </div>
            <div class="text-right">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Bestelling plaatsen</button>
            </div>
        </form>
        <div class="mt-4 text-center">
            <span class="text-lg font-bold">Totaal bedrag: €<?= number_format($totaalbedrag, 2, ',', '.') ?></span>
        </div>
    </div>
    <?php else: ?>
    <p class="text-center text-red-500">Uw winkelwagen is leeg.</p>
    <?php endif; ?>
</div>
<script>
function applyDiscount() {
    const kortingscode = document.getElementById('kortingscode').value;
    const form = document.createElement('form');
    form.method = 'post';
    form.action = '/checkout/apply-discount';
    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'kortingscode';
    input.value = kortingscode;
    form.appendChild(input);
    document.body.appendChild(form);
    form.submit();
}
</script>
<?php
view("parts/footer");
