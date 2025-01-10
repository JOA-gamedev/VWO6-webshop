<?php
// This file displays various clothing products.
view("parts/header", ['title' => 'producten']);
view("parts/navigatie-menu");
$products = [
    [
        'name' => 'T-Shirt',
        'price' => 19.99,
        'description' => 'A comfortable cotton t-shirt.',
        'image' => 'images/wizard-logo.png'
    ],
    [
        'name' => 'Jeans',
        'price' => 49.99,
        'description' => 'Stylish denim jeans.',
        'image' => 'images/wizard-logo.png'
    ],
    [
        'name' => 'Jacket',
        'price' => 89.99,
        'description' => 'Warm and cozy jacket for winter.',
        'image' => 'images/wizard-logo.png'
    ],
    [
        'name' => 'Sneakers',
        'price' => 59.99,
        'description' => 'Comfortable sneakers for everyday wear.',
        'image' => 'images/wizard-logo.png'
    ],
    [
        'name' => 'Hat',
        'price' => 14.99,
        'description' => 'A stylish hat for sunny days.',
        'image' => 'images/wizard-logo.png'
    ],
    [
        'name' => 'Scarf',
        'price' => 24.99,
        'description' => 'A warm scarf for winter.',
        'image' => 'images/wizard-logo.png'
    ],
    [
        'name' => 'Gloves',
        'price' => 9.99,
        'description' => 'Comfortable gloves for cold weather.',
        'image' => 'images/wizard-logo.png'
    ],
    [
        'name' => 'Socks',
        'price' => 4.99,
        'description' => 'A pair of cozy socks.',
        'image' => 'images/wizard-logo.png'
    ],
    [
        'name' => 'Belt',
        'price' => 19.99,
        'description' => 'A leather belt.',
        'image' => 'images/wizard-logo.png'
    ],
    [
        'name' => 'Sunglasses',
        'price' => 29.99,
        'description' => 'Stylish sunglasses.',
        'image' => 'images/wizard-logo.png'
    ],
    [
        'name' => 'Watch',
        'price' => 99.99,
        'description' => 'A classic wristwatch.',
        'image' => 'images/wizard-logo.png'
    ],
    [
        'name' => 'Backpack',
        'price' => 39.99,
        'description' => 'A durable backpack for everyday use.',
        'image' => 'images/wizard-logo.png'
    ]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-6">Producten</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php foreach ($products as $product): ?>
                <a href="/app/views/product-detail.view.php?name=<?php echo urlencode($product['name']); ?>" class="block bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200">
                    <img class="w-full h-48 object-cover mb-4" src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                    <h2 class="text-xl font-semibold mb-2"><?php echo $product['name']; ?></h2>
                    <p class="text-gray-700 mb-2"><?php echo $product['description']; ?></p>
                    <p class="text-gray-900 font-bold">Price: $<?php echo number_format($product['price'], 2); ?></p>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
<?php
view("parts/footer");
?>