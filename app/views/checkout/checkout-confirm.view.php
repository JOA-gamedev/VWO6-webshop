<?php
view("parts/header", ['title' => 'Bevestiging']);
view("parts/navigatie-menu");
?>
<div class="container mx-auto p-4">
    <h1 class="text-3xl my-4 font-bold text-center">Bevestiging</h1>
    <div class="mt-4 flex flex-row justify-between">
        <div>
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
        <div class="w-1/4">
            <h2 class="text-2xl font-bold mt-4">Totaal bedrag</h2>
            <p>Origineel bedrag: (incl. BTW)</p>
            <p class="text-right">€<?= number_format($originalAmount, 2, ',', '.') ?></p>
            </p>

            <?php if (isset($kortingscode)): ?>
                <p>
                    Korting: <?= htmlspecialchars($kortingscode['percentage']) ?>% (Code:
                    <b><?= $kortingscode['code']; ?></b>):

                </p>

                <p class="text-right">−€<?= number_format($discountAmount, 2, ',', '.') ?></p>

            <?php endif; ?>

            <p class="text-lg font-bold">Totaal bedrag: </p>
            <p class="text-right font-bold">€<?= number_format($totalAmount, 2, ',', '.') ?></p>
        </div>

    </div>
    <div class="text-right mt-4">
        <form action="/checkout/complete" method="post">
            <?= csrf() ?>
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Bestelling bevestigen</button>
        </form>
    </div>
</div>
<?php
view("parts/footer");
