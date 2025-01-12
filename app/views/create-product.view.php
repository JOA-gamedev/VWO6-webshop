<?php
view("parts/header", ['title' => 'Nieuw Product Toevoegen']);
view("parts/navigatie-menu");
$csrfToken = csrf_token(); // Generate CSRF token
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-6">Nieuw Product Toevoegen</h1>
        <form action="/VWO6-webshop/app/controllers/add-product.controller.php" method="POST"
            class="bg-white p-6 rounded-lg shadow-md">
            <input type="hidden" name="csrf_token" value="<?php echo $csrfToken; ?>">
            <div class="mb-4">
                <label for="naam" class="block text-gray-700">Naam</label>
                <input type="text" id="naam" name="naam" class="w-full p-2 border border-gray-300 rounded mt-1"
                    required>
            </div>
            <div class="mb-4">
                <label for="beschrijving" class="block text-gray-700">Beschrijving</label>
                <textarea id="beschrijving" name="beschrijving" class="w-full p-2 border border-gray-300 rounded mt-1"
                    required></textarea>
            </div>
            <div class="mb-4">
                <label for="prijs" class="block text-gray-700">Prijs</label>
                <input type="number" step="0.01" id="prijs" name="prijs"
                    class="w-full p-2 border border-gray-300 rounded mt-1" required>
            </div>
            <div class="mb-4">
                <label for="afbeelding" class="block text-gray-700">Afbeelding URL</label>
                <input type="url" id="afbeelding" name="afbeelding"
                    class="w-full p-2 border border-gray-300 rounded mt-1" required>
            </div>
            <div>
                <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition-colors duration-200">Product
                    Toevoegen</button>
            </div>
        </form>
    </div>
</body>

</html>
<?php
view("parts/footer");
?>