<?php
view("parts/header", ['title' => 'Add Product']);
view("parts/navigatie-menu");
?>

<div class="sm:mx-10">
    <h1 class="text-3xl my-4">Product toevoegen</h1>
    <a href="/productbeheer" class="bg-gray-500 text-white px-2 py-1 rounded">Terug</a>
</div>

<div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-4 text-center">Product toevoegen</h2>
    <?php if (isset($_SESSION['flash'])): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline"><?= $_SESSION['flash'] ?></span>
        </div>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>
    <?php if (isset($_SESSION['error'])): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline"><?= $_SESSION['error'] ?></span>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>
    <form action="/admin/product-add" method="post" enctype="multipart/form-data" class="space-y-4">
        <?= csrf() ?>
        <div>
            <label for="naam" class="block text-sm font-medium text-gray-700">Productnaam:</label>
            <input type="text" id="naam" name="naam" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <div>
            <label for="beschrijving" class="block text-sm font-medium text-gray-700">Beschrijving:</label>
            <textarea id="beschrijving" name="beschrijving" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
        </div>
        <div>
            <label for="prijs" class="block text-sm font-medium text-gray-700">Prijs (2 decimalen):</label>
            <input type="number" id="prijs" name="prijs" step="0.01" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <div>
            <label for="afbeelding_naam" class="block text-sm font-medium text-gray-700">Afbeeldingnaam (zonder jpg!):</label>
            <input type="text" id="afbeelding_naam" name="afbeelding_naam" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <div>
            <label for="kleur" class="block text-sm font-medium text-gray-700">Kleur:</label>
            <input type="text" id="kleur" name="kleur" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <div>
            <label for="geslacht" class="block text-sm font-medium text-gray-700">Geslacht:</label>
            <select id="geslacht" name="geslacht" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="man">Man</option>
                <option value="vrouw">Vrouw</option>
                <option value="unisex">Unisex</option>
            </select>
        </div>
        <div>
            <label for="afbeelding" class="block text-sm font-medium text-gray-700">Afbeelding:</label>
            <input type="file" id="afbeelding" name="afbeelding" accept="image/*" required class="mt-1 block w-full text-sm text-gray-500">
        </div>
        <div>
            <input type="submit" value="Toevoegen" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        </div>
    </form>
</div>

<?php
view("parts/footer");
?>
