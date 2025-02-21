<?php

view("parts/header", ['title' => 'Gebruikersbeheer']);
view("parts/navigatie-menu");
?>
<div class="sm:mx-10">
    <h1 class="text-3xl my-4">Gebruikersbeheer</h1>
    <a href="/admin/admin-dashboard" class="bg-gray-600 text-white px-2 py-1 rounded">Terug</a>
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
<div x-data="searchUsers()" class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <label for="searchfield" class="block text-sm font-medium text-gray-700">Zoek gebruikers:</label>
    <input type="text" id="searchfield" placeholder="Begin met typen..." @keyup="fetchUsers()" x-model="searchfield" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
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
                            <form method="POST" :action="user.deleted_at ? '/admin/user-restore' : '/admin/user-delete'" style="display:inline;">
                                <?= csrf() ?>
                                <input type="hidden" name="id" :value="user.id">
                                <button type="submit" :class="user.deleted_at ? 'bg-green-500' : 'bg-red-500'" class="text-white px-2 py-1 rounded">
                                    <span x-text="user.deleted_at ? 'Herstellen' : 'Verwijderen'"></span>
                                </button>
                            </form>
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
        }
    }
}
</script>

<?php
view("parts/footer");
?>
