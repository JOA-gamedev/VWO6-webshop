<?php
view("parts/header", ["title" => "Wachtwoord aanpassen"]);
view("parts/navigatie-menu");
?>

<div class="sm:mx-10">
    <h1 class="text-3xl my-4">Wachtwoord aanpassen</h1>
</div>

<?php if (isset($_SESSION['flash_message'])): ?>
    <div class="max-w-md mx-auto bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline"><?= $_SESSION['flash_message'] ?></span>
    </div>
    <?php unset($_SESSION['flash_message']); ?>
<?php endif; ?>

<form method="post" action="/wachtwoord-aanpassen" class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md">
    <?= csrf() ?>
    <div class="mb-4">
        <label for="current_password" class="block text-sm font-medium text-gray-700">Huidig wachtwoord:</label>
        <input type="password" id="current_password" name="current_password" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>
    <div class="mb-4">
        <label for="new_password" class="block text-sm font-medium text-gray-700">Nieuw wachtwoord:</label>
        <input type="password" id="new_password" name="new_password" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>
    <div class="mb-4">
        <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700">Bevestig nieuw wachtwoord:</label>
        <input type="password" id="new_password_confirmation" name="new_password_confirmation" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>
    <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Wachtwoord aanpassen</button>
</form>

<?php
view("parts/footer");
?>
