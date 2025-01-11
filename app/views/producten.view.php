<?php
// This file displays various clothing products.
view("parts/header", ['title' => 'producten']);
view("parts/navigatie-menu");

$producten = [];

try {
    // Database connection
    $db = new Database();

    // Fetch products from the database
    $producten = $db->query("SELECT * FROM producten")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Database error: ' . $e->getMessage();
    die();
}
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
            <?php foreach ($producten as $product): ?>
            <a href="/app/views/product-detail.view.php?name=<?php echo urlencode($product['naam']); ?>"
                class="block bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200">
                <img class="w-full h-48 object-cover mb-4" src="<?php echo $product['afbeelding']; ?>"
                    alt="<?php echo $product['naam']; ?>">
                <h2 class="text-xl font-semibold mb-2"><?php echo $product['naam']; ?></h2>
                <p class="text-gray-700 mb-2"><?php echo $product['beschrijving']; ?></p>
                <p class="text-gray-900 font-bold">Price: $<?php echo number_format($product['prijs'], 2); ?></p>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>
<?php
view("parts/footer");
?>