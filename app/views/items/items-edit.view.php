<?php
view("parts/header", ["title" => "Item bewerken"]);
view("parts/navigatie-menu");

$item = $data['item'] ?? [];
$errors = $data['errors'] ?? [];
?>
<div class="container mx-auto mt-8">
    <h1 class="text-2xl font-bold mb-4">Item bewerken</h1>
    <form method="POST" action="/items/items-update" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= htmlspecialchars($item['id'] ?? '') ?>">
        <div class="mb-4">
            <label for="naam" class="block text-gray-700">Naam:</label>
            <input type="text" id="naam" name="naam" value="<?= htmlspecialchars($item['naam'] ?? '') ?>" class="border border-gray-300 rounded-md p-2 w-full" required>
            <?php if (isset($errors['naam'])): ?>
                <p class="text-red-500 text-xs mt-2"><?= htmlspecialchars($errors['naam']) ?></p>
            <?php endif; ?>
        </div>
        <div class="mb-4">
            <label for="prijs" class="block text-gray-700">Prijs:</label>
            <input type="text" id="prijs" name="prijs" value="<?= htmlspecialchars($item['prijs'] ?? '') ?>" class="border border-gray-300 rounded-md p-2 w-full" required>
            <?php if (isset($errors['prijs'])): ?>
                <p class="text-red-500 text-xs mt-2"><?= htmlspecialchars($errors['prijs']) ?></p>
            <?php endif; ?>
        </div>
        <div class="mb-4">
            <label for="beschrijving" class="block text-gray-700">Beschrijving:</label>
            <textarea id="beschrijving" name="beschrijving" class="border border-gray-300 rounded-md p-2 w-full" required><?= htmlspecialchars($item['beschrijving'] ?? '') ?></textarea>
        </div>
        <div class="mb-4">
            <label for="kleur" class="block text-gray-700">Kleur:</label>
            <input type="text" id="kleur" name="kleur" value="<?= htmlspecialchars($item['kleur'] ?? '') ?>" class="border border-gray-300 rounded-md p-2 w-full" required>
        </div>
        <div class="mb-4">
            <label for="geslacht" class="block text-gray-700">Geslacht:</label>
            <select id="geslacht" name="geslacht" class="border border-gray-300 rounded-md p-2 w-full" required>
                <option value="man" <?= ($item['geslacht'] ?? '') === 'man' ? 'selected' : '' ?>>Man</option>
                <option value="vrouw" <?= ($item['geslacht'] ?? '') === 'vrouw' ? 'selected' : '' ?>>Vrouw</option>
                <option value="unisex" <?= ($item['geslacht'] ?? '') === 'unisex' ? 'selected' : '' ?>>Unisex</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="afbeelding" class="block text-gray-700">Afbeelding:</label>
            <input type="file" id="afbeelding" name="afbeelding" class="border border-gray-300 rounded-md p-2 w-full">
            <input type="hidden" name="afbeelding_naam" value="<?= htmlspecialchars($item['afbeelding'] ?? '') ?>">
        </div>
        <div class="text-center">
            <input type="submit" value="Opslaan" class="bg-blue-500 text-white rounded-md px-4 py-2 hover:bg-blue-600 cursor-pointer">
        </div>
    </form>
</div>

<?php view("parts/footer"); ?>
