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
            <div class="mb-4 p-4 border rounded shadow-sm bg-gray-200 flex flex-col h-full">
                <h2 class="text-2xl font-bold mb-2">Uw bestel nummer: <?= htmlspecialchars($order['bestelling_id'] ?? '') ?></h2>
                <div class="mb-2">
                    <?php if (!empty($order['status'])) : ?>
                        <p class="text-lg text-gray-700"><strong>Status:</strong> <?= htmlspecialchars($order['status']) ?></p>
                    <?php endif; ?>
                    <?php if (!empty($order['straat'])) : ?>
                        <p class="text-lg text-gray-700"><strong>Straat:</strong> <?= htmlspecialchars($order['straat']) ?></p>
                    <?php endif; ?>
                    <?php if (!empty($order['huisnr'])) : ?>
                        <p class="text-lg text-gray-700"><strong>Huisnummer:</strong> <?= htmlspecialchars($order['huisnr']) ?></p>
                    <?php endif; ?>
                    <?php if (!empty($order['postcode'])) : ?>
                        <p class="text-lg text-gray-700"><strong>Postcode:</strong> <?= htmlspecialchars($order['postcode']) ?></p>
                    <?php endif; ?>
                    <?php if (!empty($order['plaats'])) : ?>
                        <p class="text-lg text-gray-700"><strong>Plaats:</strong> <?= htmlspecialchars($order['plaats']) ?></p>
                    <?php endif; ?>
                    <?php if (!empty($order['created_at'])) : ?>
                        <p class="text-lg text-gray-700"><strong>Besteldatum:</strong> <?= htmlspecialchars($order['created_at']) ?></p>
                    <?php endif; ?>
                    <?php if ($order['percentage'] !== null) : ?>
                        <p class="text-lg text-gray-700"><strong>Korting:</strong> <?= htmlspecialchars($order['percentage']) . '%' ?></p>
                    <?php endif; ?>
                    <?php if (!empty($order['totaalbedrag'])) : ?>
                        <p class="text-lg text-gray-700"><strong>Totaalbedrag:</strong> &euro;<?= htmlspecialchars(number_format((float)$order['totaalbedrag'], 2, ',', '.')) ?></p>
                    <?php endif; ?>
                </div>
                <?php if (!empty($order['producten']) && is_array($order['producten'])) : ?>
                    <p class="text-lg text-gray-700"><strong>Producten:</strong></p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 flex-grow">
                        <?php foreach ($order['producten'] as $product) : ?>
                            <a href="/items/items-show?id=<?= htmlspecialchars($product['id']) ?>&from=bestel-status" class="mb-2 p-4 border rounded shadow-sm bg-white flex flex-col h-full">
                                <?php
                                $imagePath = '/images/' . htmlspecialchars($product['afbeelding'] ?? 'default.png');
                                if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $imagePath)) {
                                    $imagePath = '/images/default.png';
                                }
                                ?>
                                <img src="<?= $imagePath ?>"
                                    alt="<?= htmlspecialchars($product['naam'] ?? '') ?>" class="w-full h-32 object-contain mb-2 rounded">
                                <p class="font-semibold text-sm"><?= htmlspecialchars($product['naam'] ?? '') ?></p>
                                <p class="text-gray-700 text-sm"><?= htmlspecialchars($product['beschrijving'] ?? '') ?></p>
                                <p class="text-gray-700 text-sm">Kleur: <?= htmlspecialchars($product['kleur'] ?? '-') ?></p>
                                <p class="text-gray-700 text-sm">Geslacht: <?= htmlspecialchars($product['geslacht'] ?? '-') ?></p>
                                <p class="text-gray-700 text-sm">Maat: <?= htmlspecialchars($product['maat'] ?? '-') ?></p>
                                <p class="text-green-600 font-bold text-sm">Prijs: &euro;<?= number_format((float)$product['prijs'], 2, ',', '.') ?></p>
                                <p class="text-gray-700 text-sm">Aantal: <?= $product['aantal'] ?? 0 ?></p>
                            </a>
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