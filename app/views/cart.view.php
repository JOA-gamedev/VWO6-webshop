<?php
view("parts/header", ['title' => 'Winkelmandje']);
view("parts/navigatie-menu");

// Zorg ervoor dat $cartItems beschikbaar is
$cartItems = getCartItems();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Winkelmandje</title>
</head>
<body>
    <div class="sm:mx-10">
        <h1 class="text-3xl my-4">Winkelmandje</h1>
    </div>
    <?php if (!empty($cartItems)): ?>
        <ul>
            <?php foreach ($cartItems as $itemId): ?>
                <li>Item ID: <?php echo htmlspecialchars($itemId); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Uw winkelmandje is leeg.</p>
    <?php endif; ?>

    <!-- Voeg hier andere inhoud van de winkelmandpagina toe -->

</body>
</html>

<?php
view("parts/footer");