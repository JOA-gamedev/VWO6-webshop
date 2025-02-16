<?php

//KORTE UITLEG: dit bestand gebruikt axios om dynamisch te zoeken in de producten
//ONDERDEEL VAN ADMIN FUNCTIES

view("parts/header", ['title' => 'Zoek gebruikers']);
view("parts/navigatie-menu");
?>
<div class="sm:mx-10">
    <h1 class="text-3xl my-4">Productbeheer</h1>
    <a href="/admin-dashboard" class="bg-gray-600 text-white px-2 py-1 rounded">Terug</a>
    <a href="/admin/product-add" class="bg-indigo-600 text-white px-2 py-1 rounded">Product toevoegen</a>
</div>

<div x-data="searchProducts()" class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <label for="searchfield" class="block text-sm font-medium text-gray-700">Zoek Producten:</label>
    <input type="text" id="searchfield" placeholder="Begin met typen..." @keyup="fetchProducts()" x-model="searchfield" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    <!-- indien er resultaten gevonden zijn dan tonen -->
    <template x-if="products.length">
        <table class="border border-slate-400 dark:border-slate-300 mt-6 w-full">
            <thead>
                <tr>
                    <th class="font-bold text-left p-2">Naam</th>
                    <th class="font-bold text-left p-2">Id</th>
                    <th class="font-bold text-left p-2">Prijs</th>
                    <th class="font-bold text-left p-2">Beschrijving</th>
                    <th class="font-bold text-left p-2">Acties</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop door alle gevonden products -->
                <template x-for="product in products">
                    <tr class="bg-slate-200 hover:bg-slate-400 border border-slate-300 cursor-pointer" onclick="window.location.href='/admin/product-edit?id=' + product.id">
                        <td class="p-4" x-text="product.naam"></td>
                        <td class="p-4" x-text="product.id"></td>
                        <td class="p-4" x-text="product.prijs"></td>
                        <td x-text="product.beschrijving.length >= 50 ? product.beschrijving.substring(0, 50) + '...' : product.beschrijving" class="p-4"></td>
                        <td class="p-4">
                            <a :href="'/admin/product-edit?id=' + product.id" class="bg-indigo-600 text-white py-1 px-3 rounded-md hover:bg-indigo-700 mr-2">Wijzigen</a>
                            <form :action="product.deleted_at ? '/items/items-restore' : '/items/items-destroy'" method="post" style="display:inline;">
                                <?= csrf() ?>
                                <input type="hidden" name="id" :value="product.id">
                                <button type="submit" :class="product.deleted_at ? 'bg-green-600 hover:bg-green-700' : 'bg-red-600 hover:bg-red-700'" class="text-white py-1 px-3 rounded-md mr-2">
                                    <span x-text="product.deleted_at ? 'Herstellen' : 'Verwijderen'"></span>
                                </button>
                            </form>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </template>
    <!-- Geen resultaten -->
    <template x-if="!products.length">
        <div class="mt-10 text-gray-500">Geen producten gevonden</div>
    </template>
</div>

<script>
    function searchProducts() {
        return {
            searchfield: '', //inhoud van het zoekveld
            products: [], //dit wordt gevuld met de resultaten afkomstig van api/products.search.php
            ok: false, //gaat alles goed?

            fetchProducts() {
                axios.get('/api/productbeheer-search?name=' + this.searchfield)
                    .then((response) => {
                        this.ok = true;
                        this.products = response.data;
                        setTimeout(() => {
                            this.ok = false;
                        }, 5000);

                    }).catch((e) => {
                        console.log(e);
                    })
            },
            goto(id) {
                window.location.href = '/admin/product-edit?id=' + id;
            },
            // dlt(id) { //afkorting want delete werkt niet
            //     //Deze url bestaat nog niet maar kan je zelf aanmaken                delete functionaleit kan beter verwerkt worden in de productpagina
            //     location.href = '/delete-product?id=' + id;
            // }
        }
    }
</script>

<?php
view("parts/footer");
?>
