<?php

view("parts/header", ['title' => 'Gebruiker bewerken']);
view("parts/navigatie-menu");
?>
<div class="sm:mx-10">
    <h1 class="text-3xl my-4 font-bold text-gray-800">Gebruiker bewerken</h1>
    <a href="/user-management" class="bg-gray-500 text-white px-2 py-1 rounded">Terug</a>
</div>

<div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <form method="POST" action="/admin/user-update">
    <?= csrf() ?>
        <input type="hidden" name="id" value="<?= htmlspecialchars($user['id'] ?? '') ?>">
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Naam:</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($user['name'] ?? '') ?>" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <div class="mb-4">
            <label for="straat" class="block text-sm font-medium text-gray-700">Straat:</label>
            <input type="text" id="straat" name="straat" value="<?= htmlspecialchars($user['straat'] ?? '') ?>" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <div class="mb-4">
            <label for="huisnr" class="block text-sm font-medium text-gray-700">Huisnummer:</label>
            <input type="text" id="huisnr" name="huisnr" value="<?= htmlspecialchars($user['huisnr'] ?? '') ?>" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <div class="mb-4">
            <label for="postcode" class="block text-sm font-medium text-gray-700">Postcode:</label>
            <input type="text" id="postcode" name="postcode" value="<?= htmlspecialchars($user['postcode'] ?? '') ?>" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <div class="mb-4">
            <label for="plaats" class="block text-sm font-medium text-gray-700">Plaats:</label>
            <input type="text" id="plaats" name="plaats" value="<?= htmlspecialchars($user['plaats'] ?? '') ?>" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Wachtwoord:</label>
            <input type="password" id="password" name="password" value="<?= htmlspecialchars($user['password'] ?? '') ?>" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <button type="submit" class="mt-4 px-2 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Opslaan</button>
    </form>
    <form method="POST" action="/admin/user-delete" class="mt-4">
        <?= csrf() ?>
        <input type="hidden" name="id" value="<?= htmlspecialchars($user['id'] ?? '') ?>">
        <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">Verwijderen</button>
    </form>
    <?php if ($user['deleted_at']): ?>
    <form method="POST" action="/admin/user-restore" class="mt-4">
        <?= csrf() ?>
        <input type="hidden" name="id" value="<?= htmlspecialchars($user['id'] ?? '') ?>">
        <button type="submit" class="px-2 py-1 bg-green-500 text-white rounded hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">Herstellen</button>
    </form>
    <?php endif; ?>
</div>

<?php
view("parts/footer");
