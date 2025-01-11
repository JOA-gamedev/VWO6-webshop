<?php
view("parts/header", ['title' => 'Bestelstatus']);
view("parts/navigatie-menu");
?>
<div class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="max-w-lg mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-4">Uw bestellingen</h1>
        <?php if (!empty($orders)): ?>
            <ul class="divide-y divide-gray-300">
                <?php foreach ($orders as $order): ?>
                    <li class="py-4">
                        <p class="text-lg text-gray-700"><strong>Status:</strong> <?php echo htmlspecialchars($order['status'] ?? 'Onbekend'); ?></p>
                        <p class="text-lg text-gray-700"><strong>Straat:</strong> <?php echo htmlspecialchars($order['straat'] ?? 'Onbekend'); ?></p>
                        <p class="text-lg text-gray-700"><strong>Huisnummer:</strong> <?php echo htmlspecialchars($order['huisnr'] ?? 'Onbekend'); ?></p>
                        <p class="text-lg text-gray-700"><strong>Postcode:</strong> <?php echo htmlspecialchars($order['postcode'] ?? 'Onbekend'); ?></p>
                        <p class="text-lg text-gray-700"><strong>Plaats:</strong> <?php echo htmlspecialchars($order['plaats'] ?? 'Onbekend'); ?></p>
                        <p class="text-lg text-gray-700"><strong>Besteldatum:</strong> <?php echo htmlspecialchars($order['created_at'] ?? 'Onbekend'); ?></p>
                        <p class="text-lg text-gray-700"><strong>Kortingcode:</strong> <?php echo htmlspecialchars($order['kortingcode_id'] ?? 'Geen'); ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p class="text-lg text-gray-700">Geen bestellingen gevonden.</p>
        <?php endif; ?>
    </div>
</div>
<?php
view("parts/footer");
?>