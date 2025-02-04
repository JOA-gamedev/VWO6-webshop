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
                <?php if (!empty($order['status'])) : ?>
                    <p class="text-lg text-gray-700"><strong>Status:</strong> <?php echo htmlspecialchars($order['status']); ?>
                    </p>
                <?php endif; ?>
                <?php if (!empty($order['straat'])) : ?>
                    <p class="text-lg text-gray-700"><strong>Straat:</strong> <?php echo htmlspecialchars($order['straat']); ?>
                    </p>
                <?php endif; ?>
                <?php if (!empty($order['huisnr'])) : ?>
                    <p class="text-lg text-gray-700"><strong>Huisnummer:</strong>
                        <?php echo htmlspecialchars($order['huisnr']); ?></p>
                <?php endif; ?>
                <?php if (!empty($order['postcode'])) : ?>
                    <p class="text-lg text-gray-700"><strong>Postcode:</strong>
                        <?php echo htmlspecialchars($order['postcode']); ?></p>
                <?php endif; ?>
                <?php if (!empty($order['plaats'])) : ?>
                    <p class="text-lg text-gray-700"><strong>Plaats:</strong> <?php echo htmlspecialchars($order['plaats']); ?>
                    </p>
                <?php endif; ?>
                <?php if (!empty($order['created_at'])) : ?>
                    <p class="text-lg text-gray-700"><strong>Besteldatum:</strong>
                        <?php echo htmlspecialchars($order['created_at']); ?></p>
                <?php endif; ?>
                <?php if ($order['percentage'] !== null) : ?>
                    <p class="text-lg text-gray-700"><strong>Korting:</strong>
                        <?php echo htmlspecialchars($order['percentage']) . '%'; ?></p>
                <?php endif; ?>
                <?php if (!empty($order['totaalbedrag'])) : ?>
                    <p class="text-lg text-gray-700"><strong>Totaalbedrag:</strong>
                        &euro;<?php echo htmlspecialchars(number_format($order['totaalbedrag'], 2, ',', '.')); ?></p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php
view("parts/footer");
?>