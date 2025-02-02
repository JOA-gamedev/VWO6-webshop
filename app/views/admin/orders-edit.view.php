<?php
view("parts/header", ["title" => "Bestelling wijzigen"]);
view("parts/navigatie-menu");

$order = $order ?? [];
?>

<div class="sm:mx-10">
    <h1 class="text-3xl my-4">Bestelling wijzigen</h1>
</div>

<form method="post" action="/admin/orders" class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md">
    <?= csrf() ?>
    <input type="hidden" name="id" value="<?= htmlspecialchars($order['id']) ?>">
    <div class="mb-4">
        <label for="status" class="block text-sm font-medium text-gray-700">Status:</label>
        <input type="text" id="status" name="status" value="<?= htmlspecialchars($order['status']) ?>" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>
    <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Opslaan</button>
</form>

<?php
view("parts/footer");
?>
