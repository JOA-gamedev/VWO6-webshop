<?php
view("parts/header", ['title' => 'afbeelding toevoegen']);
view("parts/navigatie-menu");
?>
    <h1 class="text-3xl my-4">Afbeelding van <?= htmlspecialchars($item['naam']) ?> wijzigen</h1>

<form action="/afbeeldingen/<?= $item['id'] ?>" method="post">
<?= csrf(); ?>
<?= method_put() ?>
    <label for="afbeelding">Afbeelding</label><br>
    <input type="url" name="url" placeholder="URL" value="<?= htmlspecialchars($item['afbeelding']) ?>"><br>
<?php if (isset($errors['afbeelding'])): ?>
    <p class="text-red-500 text-sm my-2"><?= $errors['afbeelding'] ?></p>
<?php endif; ?>

    <input type="submit" value="Wijzigen" class="border b-gray-600 rounded py-1 px-2 hover:bg-gray-100 cursor-pointer">

<?php
view("parts/footer");