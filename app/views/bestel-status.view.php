<?php
view("parts/header", ['title' => 'Bestelstatus']);
view("parts/navigatie-menu");
?>
<div class="container mx-auto p-4">
    <h1 class="text-3xl my-4 font-bold text-center">Uw bestellingen</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <!-- loop door alle bestellingen heen -->
        <?php foreach ($orders as $order) : ?>
        <div class="mb-2 p-4 border rounded shadow-sm bg-gray-200">
            <p class="text-lg text-gray-700"><strong>Status:</strong> <?php echo htmlspecialchars($order['status'] ?? 'Onbekend'); ?></p>
            <p class="text-lg text-gray-700"><strong>Straat:</strong> <?php echo htmlspecialchars($order['straat'] ?? 'Onbekend'); ?></p>
            <p class="text-lg text-gray-700"><strong>Huisnummer:</strong> <?php echo htmlspecialchars($order['huisnr'] ?? 'Onbekend'); ?></p>
            <p class="text-lg text-gray-700"><strong>Postcode:</strong> <?php echo htmlspecialchars($order['postcode'] ?? 'Onbekend'); ?></p>
            <p class="text-lg text-gray-700"><strong>Plaats:</strong> <?php echo htmlspecialchars($order['plaats'] ?? 'Onbekend'); ?></p>
            <p class="text-lg text-gray-700"><strong>Besteldatum:</strong> <?php echo htmlspecialchars($order['created_at'] ?? 'Onbekend'); ?></p>
            <p class="text-lg text-gray-700"><strong>Korting:</strong> <?php echo $order['percentage'] !== null ? htmlspecialchars($order['percentage']) . '%' : 'Geen'; ?></p>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php
view("parts/footer");
?>