<?php
view("parts/header", ['title' => 'Bestelstatus']);
view("parts/navigatie-menu");

function getProductImage($productId) {
    // Placeholder function to fetch product image from the database
    // Replace this with actual database query logic
    // Example: return the image path based on product ID
    $images = [
        1 => 'product1.jpg',
        2 => 'product2.jpg',
        3 => 'product3.jpg',
        // Add more product images as needed
    ];
    return $images[$productId] ?? 'default-image.jpg';
}
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
                <?php if (!empty($order['producten']) && is_array($order['producten'])) : ?>
                    <p class="text-lg text-gray-700"><strong>Producten:</strong></p>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <?php foreach ($order['producten'] as $product) : ?>
                            <div class="mb-2 p-4 border rounded shadow-sm bg-white">
                                <?php
                                // Fetch product image from the database
                                $productImage = getProductImage($product['id']);
                                ?>
                                <img src="/images/<?= htmlspecialchars($productImage) ?>"
                                    alt="<?= htmlspecialchars($product['naam']) ?>" class="w-full h-48 object-contain mb-2 rounded">
                                <p class="font-semibold"><?= htmlspecialchars($product['naam']) ?></p>
                                <p class="text-gray-700"><?= htmlspecialchars($product['beschrijving']) ?></p>
                                <p class="text-green-600 font-bold">Prijs:
                                    €<?= number_format($product['prijs'], 2, ',', '.') ?></p>
                                <p class="text-gray-700">Aantal: <?= $product['aantal'] ?></p>
                                <p class="text-gray-900 font-bold">Totaal:
                                    €<?= number_format($product['totaal'], 2, ',', '.') ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php
view("parts/footer");
?>