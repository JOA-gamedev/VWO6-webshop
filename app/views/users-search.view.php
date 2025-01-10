<?php
view("parts/header", ['title' => 'Zoek gebruikers']);
view("parts/navigatie-menu");
?>
    <h1 class="font-2xl font-bold m-10">Zoek users</h1>

    <div x-data="searchUsers()" class="m-10">
        Zoek gebruikers: <input type="text" @keyup="fetchUsers()" x-model="searchfield">
        <!-- indien er resultaten gevonden zijn dan tonen -->
        <template x-if="users.length">
            <table class="w-1/2">
                <tr>
                    <td class="font-bold">Email</td>
                    <td class="font-bold">Naam</td>
                </tr>
                <!-- Loop door alle gevonden users -->
                <template x-for="user in users">
                    <tr @click="goto(user.id)" class="hover:cursor-pointer hover:bg-blue-50">
                        <td x-text="user.email"></td>
                        <td x-text="user.name"></td>
                    </tr>
                </template>
            </table>
        </template>
        <!-- Geen resultaten -->
        <template x-if="!users.length">
            <div class="mt-10">Geen gebruikers gevonden</div>
        </template>
    </div>

    <script>

        function searchUsers() {
            return {
                searchfield: '', //inhoud van het zoekveld
                users: [], //dit wordt gevuld met de resultaten afkomstig van api/users.search.php
                ok: false, //gaat alles goed?

                fetchUsers() {
                    axios.get('/api/users-search?name=' + this.searchfield)
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
                    //Deze url bestaat nog niet maar kan je zelf aanmaken
                    location.href = '/user-profile?id=' + id;
                }
            }
        }

    </script>

<?php
view("parts/footer");