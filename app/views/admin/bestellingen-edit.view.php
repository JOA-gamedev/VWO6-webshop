<?php
view("parts/header", ["title" => "Bestelling wijzigen"]);
view("parts/navigatie-menu");

$bestelling = $bestelling ?? [];
?>

<div class="sm:mx-10">
    <h1 class="text-3xl my-4">Bestelling wijzigen</h1>
    <a href="/admin/bestellingen" class="bg-gray-500 text-white px-2 py-1 rounded">Terug</a>
</div>

<form method="post" action="/admin/bestellingen" class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md">
    <?= csrf() ?>
    <input type="hidden" name="id" value="<?= htmlspecialchars($bestelling['id'] ?? '') ?>">
    <input type="hidden" name="deleted_at" value="<?= htmlspecialchars($bestelling['deleted_at'] ?? '') ?>">
    <div class="mb-4">
        <label for="klant_id" class="block text-sm font-medium text-gray-700">Klant ID:</label>
        <input type="text" id="klant_id" name="klant_id" value="<?= htmlspecialchars($bestelling['klant_id'] ?? '') ?>" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>
    <div class="mb-4">
        <label for="status" class="block text-sm font-medium text-gray-700">Status:</label>
        <input type="text" id="status" name="status" value="<?= htmlspecialchars($bestelling['status'] ?? '') ?>" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>
    <div class="mb-4">
        <label for="product_ids" class="block text-sm font-medium text-gray-700">Product IDs (comma separated):</label>
        <textarea id="product_ids" name="product_ids" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"><?= htmlspecialchars(implode(', ', $bestelling['product_ids'] ?? [])) ?></textarea>
    </div>
    <div class="mb-4">
        <label for="prijzen" class="block text-sm font-medium text-gray-700">Prijzen (comma separated):</label>
        <textarea id="prijzen" name="prijzen" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"><?= htmlspecialchars(implode(', ', $bestelling['prijzen'] ?? [])) ?></textarea>
    </div>
    <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Opslaan</button>
</form>

<?php
view("parts/footer");
?>
