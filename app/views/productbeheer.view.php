<?php

//KORTE UITLEG: dit bestand gebruikt axios om dynamisch te zoeken in de producten
//ONDERDEEL VAN ADMIN FUNCTIES

view("parts/header", ['title' => 'Zoek gebruikers']);
view("parts/navigatie-menu");
?>
<div class="sm:mx-10">
    <h1 class="text-3xl my-4">Productbeheer</h1>
</div>

<div x-data="searchProducts()" class="m-10 p-4 flex flex-col justify-center items-center">
    Zoek Producten: <input type="text" placeholder="begin te typen..." @keyup="fetchProducts()" x-model="searchfield">
    <!-- indien er resultaten gevonden zijn dan tonen -->
    <template x-if="products.length">
        <table class="border border-slate-400 dark:border-slate-300 mt-6 w-1/2">
            <thead>
                <tr>
                    <th class="font-bold">Naam</th>
                    <th class="font-bold">Id</th>
                    <th class="font-bold">Prijs</th>
                    <th class="font-bold">beschrijving</td>
                </tr>
            </thead>
            <tbody>
                <!-- Loop door alle gevonden products -->
                <template x-for="product in products">

                    <tr @click="goto(product.id)" class="bg-slate-200 hover:bg-slate-400 border border-slate-300">

                        <td class="p-4" x-text="product.naam"></td>
                        <td class="p-4" x-text="product.id"></td>
                        <td class="p-4" x-text="product.prijs"></td>

                        <td x-text="product.beschrijving.length >= 50 ? product.beschrijving.substring(0, 50) + '...' : product.beschrijving"
                            class="p-4">
                        </td>
                    </tr>

                </template>
            </tbody>
        </table>
    </template>
    <!-- Geen resultaten -->
    <template x-if="!products.length">
        <div class="mt-10">Geen producten gevonden</div>
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
                //Deze url bestaat nog niet maar kan je zelf aanmaken
                location.href = '/items/items-edit?id=' + id;
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
