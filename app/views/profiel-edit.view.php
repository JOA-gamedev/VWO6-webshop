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
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($profile['name'] ?? '') ?>" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>
    <div class="mb-4">
        <label for="email" class="block text-sm font-medium text-gray-700">E-mail:</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($profile['email'] ?? '') ?>" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>
    <div class="mb-4">
        <label for="straat" class="block text-sm font-medium text-gray-700">Straat:</label>
        <input type="text" id="straat" name="straat" value="<?= htmlspecialchars($profile['straat'] ?? '') ?>" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>
    <div class="mb-4">
        <label for="huisnr" class="block text-sm font-medium text-gray-700">Huisnummer:</label>
        <input type="text" id="huisnr" name="huisnr" value="<?= htmlspecialchars($profile['huisnr'] ?? '') ?>" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>
    <div class="mb-4">
        <label for="postcode" class="block text-sm font-medium text-gray-700">Postcode:</label>
        <input type="text" id="postcode" name="postcode" value="<?= htmlspecialchars($profile['postcode'] ?? '') ?>" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>
    <div class="mb-4">
        <label for="plaats" class="block text-sm font-medium text-gray-700">Plaats:</label>
        <input type="text" id="plaats" name="plaats" value="<?= htmlspecialchars($profile['plaats'] ?? '') ?>" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>
    <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Opslaan</button>
</form>

<!-- Delete Profile Form -->
<form method="post" action="/profiel-delete" class="max-w-md mx-auto mt-4" id="deleteProfileForm">
    <?= csrf() ?>
    <button type="button" class="w-full bg-red-600 text-white py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" onclick="showDeleteModal()">Verwijder Profiel</button>
</form>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Bevestig Verwijdering</h3>
            <div class="mt-2">
                <p class="text-sm text-gray-500">Weet u zeker dat u uw profiel wilt verwijderen?</p>
            </div>
            <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm" onclick="confirmDeletion()">Verwijder</button>
                <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm" onclick="hideDeleteModal()">Annuleer</button>
            </div>
        </div>
    </div>
</div>

<script>
function showDeleteModal() {
    document.getElementById('deleteModal').classList.remove('hidden');
}

function hideDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
}

function confirmDeletion() {
    document.getElementById('deleteProfileForm').submit();
}
</script>

<?php
view("parts/footer");
?>