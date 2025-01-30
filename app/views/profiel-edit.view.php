<?php
view("parts/header", ["title" => "Profiel bewerken"]);
view("parts/navigatie-menu");
?>

<div class="sm:mx-10">
    <h1 class="text-3xl my-4">Profiel bewerken</h1>
</div>

<?php if (isset($_SESSION['flash_message'])): ?>
    <div class="max-w-md mx-auto bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline"><?= $_SESSION['flash_message'] ?></span>
    </div>
    <?php unset($_SESSION['flash_message']); ?>
<?php endif; ?>

<form method="post" action="/profiel-update" class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md">
    <?= csrf() ?>
    <div class="mb-4">
        <label for="name" class="block text-sm font-medium text-gray-700">Naam:</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($profile['name']) ?>" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>
    <div class="mb-4">
        <label for="email" class="block text-sm font-medium text-gray-700">E-mail:</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($profile['email']) ?>" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>
    <div class="mb-4">
        <label for="password" class="block text-sm font-medium text-gray-700">Nieuw wachtwoord:</label>
        <input type="password" id="password" name="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>
    <div class="mb-4">
        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Bevestig nieuw wachtwoord:</label>
        <input type="password" id="password_confirmation" name="password_confirmation" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>
    <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Opslaan</button>
</form>

<form method="post" action="/profiel-delete" class="max-w-md mx-auto mt-4">
    <?= csrf() ?>
    <button type="submit" class="w-full bg-red-600 text-white py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">Verwijder Profiel</button>
</form>

<?php
view("parts/footer");
?>