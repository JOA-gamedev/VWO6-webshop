<?php
// This file displays detailed information about a single product.
view("parts/header", ['title' => 'Product Details']);
view("parts/navigatie-menu");

$product = null;

if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    try {
        // Database connection
        $db = new PDO('mysql:host=localhost;dbname=your_database_name', 'correct_username', 'correct_password');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Fetch product details from the database
        $stmt = $db->prepare("SELECT * FROM producten WHERE id = :id");
        $stmt->execute(['id' => $productId]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Database error: ' . $e->getMessage();
        die();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <?php if ($product): ?>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h1 class="text-3xl font-bold mb-6"><?php echo $product['naam']; ?></h1>
            <img class="w-full h-96 object-cover mb-4" src="<?php echo $product['afbeelding']; ?>"
                alt="<?php echo $product['naam']; ?>">
            <p class="text-gray-700 mb-4"><?php echo $product['beschrijving']; ?></p>
            <p class="text-gray-900 font-bold text-2xl mb-4">Price: $<?php echo number_format($product['prijs'], 2); ?>
            </p>
            <!-- Add to cart form -->
            <form action="/cart/add" method="post">
            <?= csrf() ?>
                <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add to Cart</button>
            </form>
        </div>
        <?php else: ?>
        <p class="text-red-500">Product not found.</p>
        <?php endif; ?>
    </div>
</body>

</html>
<?php
view("parts/footer");
?>