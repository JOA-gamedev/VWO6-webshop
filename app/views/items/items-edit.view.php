<?php
view("parts/header", ['title' => 'Item wijzigen']);
view("parts/navigatie-menu");
?>

<div class="sm:mx-10">
    <h1 class="text-3xl my-4">Item wijzigen</h1>
    <a href="/productbeheer" class="bg-gray-500 text-white px-2 py-1 rounded">Terug</a>
</div>

<div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-4 text-center">Item <?= htmlspecialchars($item['naam']) ?> wijzigen</h2>
    <?php if ($item['deleted_at'] === null): ?>
        <form action="/items/items-update" method="post" class="space-y-4">
            <?= csrf(); ?>
            <div>
                <label for="naam" class="block text-sm font-medium text-gray-700">Naam:</label>
                <input type="text" name="naam" id="naam" placeholder="naam" value="<?= htmlspecialchars($item['naam']) ?>" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <?php if (isset($errors['naam'])): ?>
                    <p class="text-red-500 text-sm my-2"><?= $errors['naam'] ?></p>
                <?php endif; ?>
            </div>
            <div>
                <label for="beschrijving" class="block text-sm font-medium text-gray-700">Beschrijving:</label>
                <textarea name="beschrijving" id="beschrijving" cols="30" rows="3" placeholder="beschrijving" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"><?= htmlspecialchars($item['beschrijving']) ?></textarea>
                <?php if (isset($errors['beschrijving'])): ?>
                    <p class="text-red-500 text-sm my-2"><?= $errors['beschrijving'] ?></p>
                <?php endif; ?>
            </div>
            <div>
                <label for="prijs" class="block text-sm font-medium text-gray-700">Prijs:</label>
                <input type="number" step="0.01" name="prijs" id="prijs" placeholder="prijs" value="<?= htmlspecialchars($item['prijs']) ?>" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <?php if (isset($errors['prijs'])): ?>
                    <p class="text-red-500 text-sm my-2"><?= $errors['prijs'] ?></p>
                <?php endif; ?>
            </div>
            <input name="id" type="hidden" value="<?= $_GET["id"] ?>">
            <div>
                <input type="submit" value="Wijzigen" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            </div>
        </form>
    <?php else: ?>
        <p class="text-red-500">This item has been deleted and cannot be edited.</p>
    <?php endif; ?>
</div>

<?php
view("parts/footer");
?>
