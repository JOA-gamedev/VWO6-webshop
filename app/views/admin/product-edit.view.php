<?php
view("parts/header", ["title" => "Product wijzigen"]);
view("parts/navigatie-menu");

$product = $product ?? [];
?>

<div class="sm:mx-10">
    <h1 class="text-3xl my-4">Product wijzigen</h1>
    <a href="/admin/productbeheer" class="bg-gray-500 text-white px-2 py-1 rounded">Terug</a>
</div>

<form method="post" action="/admin/product-update" class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md">
    <?= csrf() ?>
    <input type="hidden" name="id" value="<?= htmlspecialchars($product['id'] ?? '') ?>">
    <div class="mb-4">
        <label for="naam" class="block text-sm font-medium text-gray-700">Naam:</label>
        <input type="text" id="naam" name="naam" value="<?= htmlspecialchars($product['naam'] ?? '') ?>" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>
    <div class="mb-4">
        <label for="prijs" class="block text-sm font-medium text-gray-700">Prijs:</label>
        <input type="text" id="prijs" name="prijs" value="<?= htmlspecialchars($product['prijs'] ?? '') ?>" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>
    <div class="mb-4">
        <label for="beschrijving" class="block text-sm font-medium text-gray-700">Beschrijving:</label>
        <textarea id="beschrijving" name="beschrijving" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"><?= htmlspecialchars($product['beschrijving'] ?? '') ?></textarea>
    </div>
    <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Opslaan</button>
</form>

<?php
view("parts/footer");
?>
