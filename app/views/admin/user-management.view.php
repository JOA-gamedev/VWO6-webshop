<?php

view("parts/header", ['title' => 'Gebruikersbeheer']);
view("parts/navigatie-menu");
?>
<div class="sm:mx-10">
    <h1 class="text-3xl my-4">Gebruikersbeheer</h1>
    <a href="/admin-dashboard" class="bg-gray-500 text-white px-2 py-1 rounded">Terug</a>
</div>

<!-- Flash message -->
<?php if (isset($_SESSION['flash'])): ?>
    <div class="max-w-md mx-auto bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline"><?= htmlspecialchars($_SESSION['flash']) ?></span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none';">
            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 5.652a1 1 0 00-1.414 0L10 8.586 7.066 5.652a1 1 0 10-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 101.414 1.414L10 11.414l2.934 2.934a1 1 0 001.414-1.414L11.414 10l2.934-2.934a1 1 0 000-1.414z"/></svg>
        </span>
    </div>
    <?php unset($_SESSION['flash']); ?>
<?php endif; ?>

<!-- user search -->
<div x-data="searchUsers()" class="m-10">
    <div class="mb-4">
        Zoek gebruikers: <input type="text" @keyup="fetchUsers()" x-model="searchfield" class="border p-2 rounded">
    </div>
    <!-- indien er resultaten gevonden zijn dan tonen -->
    <template x-if="users.length">
        <table class="border border-slate-400 dark:border-slate-300 mt-6 w-full">
            <thead>
                <tr>
                    <th class="font-bold text-left p-2">Naam</th>
                    <th class="font-bold text-left p-2">Email</th>
                    <th class="font-bold text-left p-2">Acties</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop door alle gevonden users -->
                <template x-for="user in users" :key="user.id">
                    <tr class="bg-slate-200 hover:bg-slate-400 border border-slate-300 hover:cursor-pointer" @click="goto(user.id)">
                        <td class="p-4" x-text="user.name"></td>
                        <td class="p-4" x-text="user.email"></td>
                        <td class="p-4 flex space-x-2">
                            <template x-if="user.deleted_at">
                                <span class="text-red-500">Verwijderd</span>
                                <form method="POST" action="/admin/user-restore" style="display:inline;">
                                    <?= csrf() ?>
                                    <input type="hidden" name="id" :value="user.id">
                                    <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded">Ongedaan maken</button>
                                </form>
                            </template>
                            <template x-if="!user.deleted_at">
                                <a :href="'/admin/user-edit?id=' + user.id" class="bg-blue-500 text-white px-2 py-1 rounded">Bewerken</a>
                                <form method="POST" action="/admin/user-delete" style="display:inline;" id="deleteUserForm">
                                    <?= csrf() ?>
                                    <input type="hidden" name="id" id="deleteUserId" :value="user.id">
                                    <button type="button" class="bg-red-500 text-white px-2 py-1 rounded" @click.stop="showDeleteModal(user.id)">Verwijderen</button>
                                </form>
                            </template>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </template>
    <!-- Geen resultaten -->
    <template x-if="!users.length">
        <div class="mt-10 text-gray-500">Geen gebruikers gevonden</div>
    </template>
</div>

<script>
function searchUsers() {
    return {
        searchfield: '', //inhoud van het zoekveld
        users: [], //dit wordt gevuld met de resultaten afkomstig van api/users.search.php
        ok: false, //gaat alles goed?

        fetchUsers() {
            axios.get('/api/users-search?search=' + this.searchfield)
                .then((response) => {
                    this.ok = true;
                    this.users = response.data;
                    setTimeout(() => {
                        this.ok = false;
                    }, 5000);
                }).catch((e) => {
                console.log(e);
            })
        },
        goto(id) {
            location.href = '/admin/user-edit?id=' + id;
        },
        showDeleteModal(userId) {
            document.getElementById('deleteUserId').value = userId;
            document.getElementById('deleteModal').classList.remove('hidden');
        },
        hideDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        },
        confirmDeletion() {
            document.getElementById('deleteUserForm').submit();
        }
    }
}
</script>

<div id="deleteModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Bevestig Verwijdering</h3>
            <div class="mt-2">
                <p class="text-sm text-gray-500">Weet je zeker dat je deze gebruiker wilt verwijderen?</p>
            </div>
            <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm" @click="confirmDeletion()">Verwijder</button>
                <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm" @click="hideDeleteModal()">Annuleer</button>
            </div>
        </div>
    </div>
</div>

<?php
view("parts/footer");
?>
