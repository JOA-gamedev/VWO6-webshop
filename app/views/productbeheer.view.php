<?php
view("parts/header", ['title' => 'Zoek gebruikers']);
view("parts/navigatie-menu");
?>
    <h1 class="font-2xl font-bold m-10">Zoek Producten</h1>

    <div x-data="searchProducts()" class="m-10">
        Zoek Producten: <input type="text" @keyup="fetchProducts()" x-model="searchfield">
        <!-- indien er resultaten gevonden zijn dan tonen -->
        <template x-if="products.length">
            <table class="w-1/2">
                <!-- <tr>
                    <td class="font-bold">Naam</td>
                    <td class="font-bold">Id</td>
                     <td class="font-bold">Prijs</td>
                    <td class="font-bold">Edit</td>
                </tr> -->
                <!-- Loop door alle gevonden products -->
                <template x-for="product in products">
                    <tr @click="goto(product.id)" class="hover:cursor-pointer hover:bg-blue-50">
                    <!-- <tr> -->
                        <td x-text="product.naam"></td>
                        <td x-text="product.id"></td>

                        <!-- <td @click="goto(product.id)">Edit</td> kan beter niet-->
                        <!-- <td @click="dlt(product.id)">Delete</td> -->
                        <!-- <td x-text="product.prijs"></td>
                        <td x-text="product.type_id"></td>
                        <td x-text="product.beschrijving"></td> -->

                        <!-- edit button -->
                    </tr>
                </template>
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
                    location.href = '/product-edit?id=' + id;
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