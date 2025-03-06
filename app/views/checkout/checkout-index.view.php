<?php
view("parts/header", ['title' => 'Afrekenen']);
view("parts/navigatie-menu");
?>
<div class="container mx-auto p-4">
    <a href="/cart" class="bg-gray-500 text-white px-2 py-1 rounded">Terug</a>
    <h1 class="text-3xl my-4 font-bold text-center">Afrekenen</h1>
    <?php if (!empty($producten)): ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <?php foreach ($producten as $product): ?>
        <div class="mb-2 p-4 border rounded shadow-sm">
            <img src="<?= htmlspecialchars('/images/' . ($product['afbeelding'] ?? 'default.png')) ?>"
                alt="<?= htmlspecialchars($product['naam'] ?? '') ?>" class="w-full h-48 object-contain mb-2 rounded">
            <span class="font-semibold"><?= htmlspecialchars($product['naam'] ?? '') ?></span><br>
            <span class="text-gray-700"><?= htmlspecialchars($product['beschrijving'] ?? '') ?></span><br>
            <span class="text-green-600 font-bold">Prijs:
                €<?= number_format($product['prijs'] ?? 0, 2, ',', '.') ?></span><br>
            <span class="text-gray-700">Maat: <?= htmlspecialchars($product['maat'] ?? '') ?></span><br>
            <span class="text-gray-700">Aantal: <?= $product['aantal'] ?? 0 ?></span><br>
            <span class="text-gray-900 font-bold">Totaal:
                €<?= number_format($product['totaal'] ?? 0, 2, ',', '.') ?></span><br>
        </div>
        <?php endforeach; ?>
    </div>
    <div class="mt-4">
        <h2 class="text-2xl font-bold">Verzendinformatie</h2>
        <form action="/checkout/process" method="post" class="mt-4">
            <?= csrf() ?>
            <div class="mb-4">
                <label for="naam" class="block text-sm font-medium text-gray-700">Naam:</label>
                <input type="text" id="naam" name="naam" value="<?= htmlspecialchars($profile['naam'] ?? '') ?>"
                    required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div class="mb-4">
                <label for="straat" class="block text-sm font-medium text-gray-700">Straat:</label>
                <input type="text" id="straat" name="straat" value="<?= htmlspecialchars($profile['straat'] ?? '') ?>"
                    required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div class="mb-4">
                <label for="huisnummer" class="block text-sm font-medium text-gray-700">Huisnummer:</label>
                <input type="text" id="huisnummer" name="huisnummer"
                    value="<?= htmlspecialchars($profile['huisnummer'] ?? '') ?>" required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div class="mb-4">
                <label for="postcode" class="block text-sm font-medium text-gray-700">Postcode:</label>
                <input type="text" id="postcode" name="postcode"
                    value="<?= htmlspecialchars($profile['postcode'] ?? '') ?>" required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div class="mb-4">
                <label for="plaats" class="block text-sm font-medium text-gray-700">Plaats:</label>
                <input type="text" id="plaats" name="plaats" value="<?= htmlspecialchars($profile['plaats'] ?? '') ?>"
                    required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <h2 class="text-2xl font-bold mt-4">Betalingsinformatie</h2>
            <div class="mb-4">
                <label for="kaartnummer" class="block text-sm font-medium text-gray-700">Kaartnummer:</label>
                <input type="text" id="kaartnummer" name="kaartnummer"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    required>
            </div>
            <div class="mb-4">
                <label for="vervaldatum" class="block text-sm font-medium text-gray-700">Vervaldatum:</label>
                <input type="text" id="vervaldatum" name="vervaldatum"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    placeholder="MM/YY" required>
            </div>
            <div class="mb-4">
                <label for="cvv" class="block text-sm font-medium text-gray-700">CVV:</label>
                <input type="text" id="cvv" name="cvv"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    required>
            </div>
            <!-- hier heb ik de Kortingscode input weggehaald -->
            <div class="text-right">
                <button type="submit" class="bg-[#52EBEB] text-white px-4 py-2 rounded">Bestelling plaatsen</button>
            </div>
        </form>
        <!-- aparte form voor kortingscode -->
        <div class="mt-4 discount p-4 rounded-md">
            <h2 class="text-2xl font-bold mt-4">Kortingscode</h2>
            <div class="mb-4">
                <label for="kc_input" class="block text-sm font-medium text-gray-700">Kortingscode:</label>
                <div class="flex items-center">
                    <input type="text" id="kc_input" name="kortingscode"
                        class="mt-1 block w-1/7 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <button type="button" id="apply-discount"
                        class="ml-2 bg-[#52EBEB] hover:bg-[#3BBDBD] text-white px-2 py-1 rounded">Toevoegen</button>
                </div>
            </div>
            <div id="kortingscode-message" class="mt-2"></div>
        </div>
        <div class="mt-4 text-center">
            <span class="text-lg font-bold" id="totaalbedrag">Totaal bedrag:
                €<?= $totaalbedrag ?></span><br>
        </div>
    </div>
    <?php else: ?>
    <p class="text-center text-red-500">Uw winkelwagen is leeg.</p>
    <?php endif; ?>
</div>
<script>
document.getElementById('apply-discount').addEventListener('click', function() {
    const kortingscode = document.getElementById('kc_input').value;
    axios.get('/checkout/apply-discount?kortingscode=' + encodeURIComponent(kortingscode))
        .then(response => {
            const messageElement = document.getElementById('kortingscode-message');
            if (response.data.success) {
                document.querySelector('.discount').classList.remove('bg-red-100');
                document.querySelector('.discount').classList.add('bg-green-100');
                messageElement.classList.remove('text-red-700');
                messageElement.classList.add('text-green-700');
                document.getElementById('totaalbedrag').innerText = 'Totaal bedrag: €' + response.data
                    .totaal;
            } else {
                document.querySelector('.discount').classList.remove('bg-green-100');
                document.querySelector('.discount').classList.add('bg-red-100');
                messageElement.classList.remove('text-green-700');
                messageElement.classList.add('text-red-700');
            }
            messageElement.innerText = response.data.message;
        })
        .catch(error => {
            console.error(error);
            const messageElement = document.getElementById('kortingscode-message');
            document.querySelector('.discount').classList.remove('bg-green-100');
            document.querySelector('.discount').classList.add('bg-red-100');
            messageElement.classList.remove('text-green-700');
            messageElement.classList.add('text-red-700');
            messageElement.innerText = 'Er is een fout opgetreden.';
        });
});
</script>
<?php
view("parts/footer");
?>