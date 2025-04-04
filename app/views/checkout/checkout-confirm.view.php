<?php
view("parts/header", ['title' => 'Bevestiging']);
view("parts/navigatie-menu");
?>
<div class="container mx-auto p-4">
    <a href="javascript:history.back()" class="bg-gray-500 text-white px-2 py-1 rounded">Terug</a>
    <h1 class="text-3xl my-4 font-bold text-center">Bevestiging</h1>
    <div class="mt-4 flex flex-col md:flex-row justify-between">
        <div class="md:w-1/2">
            <h2 class="text-2xl font-bold">Verzendinformatie</h2>
            <p>Naam: <?= htmlspecialchars($order['naam']) ?></p>
            <p>Straat: <?= htmlspecialchars($order['straat']) ?></p>
            <p>Huisnummer: <?= htmlspecialchars($order['huisnummer']) ?></p>
            <p>Postcode: <?= htmlspecialchars($order['postcode']) ?></p>
            <p>Plaats: <?= htmlspecialchars($order['plaats']) ?></p>
            <h2 class="text-2xl font-bold mt-4">Betalingsinformatie</h2>
            <p>Kaartnummer: <?= htmlspecialchars($order['kaartnummer']) ?></p>
            <p>Vervaldatum: <?= htmlspecialchars($order['vervaldatum']) ?></p>
            <p>CVV: <?= htmlspecialchars($order['cvv']) ?></p>
        </div>

        <!-- discount berekening code in de controller gezet -->

        <!-- TODO verander de width naar iets wat zin maakt -->
        <div class="md:w-1/4">
            <h2 class="text-2xl font-bold mt-4">Totaal bedrag</h2>
            <p>Origineel bedrag (incl. BTW):</p>
            <p class="text-right">€<?= $originalAmount ?></p>

            <?php if (isset($kortingscode)): ?>
                <p>
                    Korting: <?= htmlspecialchars($kortingscode['percentage']) ?>% (Code:
                    <b><?= $kortingscode['code']; ?></b>):
                </p>
                <p class="text-right">−€<?= $discountAmount ?></p>
            <?php endif; ?>

            <p class="text-lg font-bold">Totaal bedrag: </p>
            <p class="text-right font-bold">€<?= $totalAmount ?></p>
        </div>
    </div>

    <div class="mt-4">
        <h2 class="text-2xl font-bold">Producten</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <?php foreach ($producten as $product): ?>
                <div class="mb-2 p-2 border rounded shadow-sm">
                    <img src="<?= htmlspecialchars('/images/' . ($product['afbeelding'] ?? 'default.png')) ?>"
                        alt="<?= htmlspecialchars($product['naam'] ?? '') ?>" class="w-full h-24 object-contain mb-2 rounded">
                    <span class="font-semibold"><?= htmlspecialchars($product['naam'] ?? '') ?></span><br>
                    <span class="text-gray-700">Maat: <?= htmlspecialchars($product['maat'] ?? '') ?></span><br>
                    <span class="text-gray-700">Aantal: <?= $product['aantal'] ?? 0 ?></span><br>
                    <span class="text-gray-900 font-bold">Totaal:
                        €<?= number_format($product['totaal'] ?? 0, 2, ',', '.') ?></span><br>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="text-right mt-4">
        <form action="/checkout/complete" method="post" class="inline-block">
            <?= csrf() ?>
            <button type="submit" class="bg-[#52EBEB] text-white px-4 py-2 rounded">Bestelling bevestigen</button>
        </form>
    </div>
</div>
<?php
view("parts/footer");
?>
