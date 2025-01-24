<?php
// This file displays the details of a single product.
view("parts/header", ['title' => 'Product Detail']);
view("parts/navigatie-menu");

$products = [
    // ...same product array as in producten.view.php...
];

$productName = urldecode($_GET['name']);
$product = array_filter($products, function($p) use ($productName) {
    return $p['name'] === $productName;
});
$product = reset($product);

if (!$product) {
    // Redirect to products page if product not found
    header("Location: producten.view.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-6"><?php echo $product['name']; ?></h1>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <img class="w-full h-64 object-cover mb-4" src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
            <p class="text-gray-700 mb-4"><?php echo $product['description']; ?></p>
            <p class="text-gray-900 font-bold text-xl mb-4">Price: $<?php echo number_format($product['price'], 2); ?></p>
            <a href="producten.view.php" class="text-blue-500 hover:underline">Back to products</a>
        </div>
    </div>
</body>
</html>
<?php
view("parts/footer");
?>
