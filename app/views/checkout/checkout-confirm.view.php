<?php
view("parts/header", ['title' => 'Bevestiging']);
view("parts/navigatie-menu");
?>
<div class="container mx-auto p-4">
    <h1 class="text-3xl my-4 font-bold text-center">Bevestiging</h1>
    <div class="mt-4">
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
        <h2 class="text-2xl font-bold mt-4">Totaal bedrag</h2>
        <?php
        $database = new Database(); // Initialize the $database variable
        $originalAmount = array_reduce(array_keys($_SESSION['winkelwagen']), function ($carry, $id) use ($database) {
            $product = $database->query('SELECT prijs FROM producten WHERE id = ?', [$id])->fetch();
            return $carry + ($product ? $product['prijs'] * $_SESSION['winkelwagen'][$id] : 0);
        }, 0);
        $discountAmount = $originalAmount - $order['totaalbedrag'];
        ?>
        <p>Origineel bedrag: <span class="line-through">€<?= number_format($originalAmount, 2, ',', '.') ?></span></p>
        <?php if (isset($order['kortingcode'])): ?>
            <p>Korting: <?= htmlspecialchars($order['kortingcode']['percentage']) ?>% (−€<?= number_format($discountAmount, 2, ',', '.') ?>)</p>
        <?php endif; ?>
        <p class="text-lg font-bold">Totaal bedrag: €<?= number_format($order['totaalbedrag'], 2, ',', '.') ?></p>
        <div class="text-right mt-4">
            <form action="/checkout/complete" method="post">
                <?= csrf() ?>
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Bestelling bevestigen</button>
            </form>
        </div>
    </div>
</div>
<?php
view("parts/footer");
