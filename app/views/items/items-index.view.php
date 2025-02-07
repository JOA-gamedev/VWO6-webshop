<?php
view("parts/header", ['title' => 'Producten']);
view("parts/navigatie-menu");
?>
<div class="container mx-auto p-4">
    <h1 class="text-3xl my-4 font-bold text-center">Producten</h1>

    <!-- Zoekformulier -->
    <form method="GET" action="" class="mb-4 flex justify-start">
        <input type="text" name="search" placeholder="Zoek producten..." class="border p-2 rounded w-1/3"
            value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded ml-2">Zoeken</button>
    </form>

    <!-- Filter knop -->
    <button id="toggleFilters" class="bg-blue-500 text-white px-3 py-1 rounded mb-4">Toon filters</button>

    <div class="main">
        <div class="custom-wrapper">
            <style>
                /* Styles for the price input container */
                .price-input-container {
                    width: 100%;
                }

                .price-input .price-field {
                    display: flex;
                    margin-bottom: 22px;
                }

                .price-field span {
                    margin-right: 10px;
                    margin-top: 6px;
                    font-size: 17px;
                }

                .price-field input {
                    flex: 1;
                    height: 35px;
                    font-size: 15px;
                    font-family: "DM Sans", sans-serif;
                    border-radius: 9px;
                    text-align: center;
                    border: 0px;
                    background: #e4e4e4;
                }

                .price-input {
                    width: 100%;
                    font-size: 19px;
                    color: #555;
                }

                /* Remove Arrows/Spinners */
                input::-webkit-outer-spin-button,
                input::-webkit-inner-spin-button {
                    -webkit-appearance: none;
                    margin: 0;
                }

                .slider-container {
                    width: 100%;
                }

                .slider-container {
                    height: 6px;
                    position: relative;
                    background: #e4e4e4;
                    border-radius: 5px;
                }

                .slider-container .price-slider {
                    height: 100%;
                    left: 25%;
                    right: 15%;
                    position: absolute;
                    border-radius: 5px;
                    background: #01940b;
                }

                .range-input {
                    position: relative;
                }

                .range-input input {
                    position: absolute;
                    width: 100%;
                    height: 5px;
                    background: none;
                    top: -5px;
                    pointer-events: none;
                    cursor: pointer;
                    -webkit-appearance: none;
                }

                /* Styles for the range thumb in WebKit browsers */
                input[type="range"]::-webkit-slider-thumb {
                    height: 18px;
                    width: 18px;
                    border-radius: 70%;
                    background: #555;
                    pointer-events: auto;
                    -webkit-appearance: none;
                }
            </style>
            <div class="price-input-container">
                <div class="price-input">
                    <div class="price-field">
                        <span>Minimum Price</span>
                        <input type="number" class="min-input" value="2500">
                    </div>
                    <div class="price-field">
                        <span>Maximum Price</span>
                        <input type="number" class="max-input" value="8500">
                    </div>
                </div>
                <div class="slider-container">
                    <div class="price-slider">
                    </div>
                </div>
            </div>

            <!-- Slider -->
            <div class="range-input">
                <input type="range" class="min-range" min="0" max="10000" value="2500" step="1">
                <input type="range" class="max-range" min="0" max="10000" value="8500" step="1">
            </div>
        </div>
    </div>

    <!-- Filteropties -->
    <form id="filterForm" method="GET" action=""
        class="mb-4 flex flex-wrap justify-start hidden bg-gray-100 p-4 rounded shadow">
        <select name="filter_color" class="border p-1 rounded w-1/4 ml-2">
            <option value="">Filter op kleur</option>
            <option value="bruin">Bruin</option>
            <option value="roze">Roze</option>
            <option value="beige">Beige</option>
            <option value="grijs">Grijs</option>
            <option value="zwart">Zwart</option>
            <option value="wit">Wit</option>
        </select>
        <select name="filter_price" class="border p-1 rounded w-1/4 ml-2">
            <option value="">Filter op prijs</option>
            <option value="0-50">0 - 50</option>
            <option value="51-100">51 - 100</option>
            <option value="101-200">101 - 200</option>
            <!-- Voeg meer prijsklassen toe indien nodig -->
        </select>
        <select name="filter_gender" class="border p-1 rounded w-1/4 ml-2">
            <option value="">Filter op geslacht</option>
            <option value="male">Man</option>
            <option value="female">Vrouw</option>
            <option value="unisex">Unisex</option>
            <!-- Voeg meer geslachten toe indien nodig -->
        </select>
        <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded ml-2">Filteren</button>
        <a href="/items/items-index" class="bg-red-500 text-white px-2 py-1 rounded ml-2">Verwijder filters</a>
    </form>

    <?php if (empty($items)) : ?>
        <p class="text-center text-red-500">Geen producten gevonden die aan deze eisen voldoen.</p>
    <?php else : ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- loop door alle items heen -->
            <?php foreach ($items as $item) : ?>
                <?php if ($item['deleted_at'] === null): ?>
                    <div class="mb-2 p-4 border rounded shadow-sm flex flex-col justify-between">
                        <div>
                            <a href="/items/items-show/<?= htmlspecialchars($item['id']) ?>">
                                <img src="/images/<?= htmlspecialchars($item['afbeelding']) ?>"
                                    alt="<?= htmlspecialchars($item['naam']) ?>" class="w-full h-48 object-contain mb-2 rounded">
                            </a>
                            <a href="/items/items-show/<?= htmlspecialchars($item['id']) ?>" class="font-semibold">
                                <?= htmlspecialchars($item['naam']) ?>
                            </a><br>
                            <span class="text-gray-700"><?= htmlspecialchars($item['beschrijving']) ?></span><br>
                            <span class="text-gray-700">Kleur: <?= htmlspecialchars($item['kleur'] ?? '-') ?></span><br>
                            <span class="text-gray-700">Geslacht: <?= htmlspecialchars($item['geslacht'] ?? '-') ?></span><br>
                            <span class="text-green-600 font-bold"><?= htmlspecialchars($item['prijs']) ?></span><br>
                            <label for="size-<?= $item['id'] ?>" class="block text-sm font-medium text-gray-700">Maat:</label>
                            <select id="size-<?= $item['id'] ?>" name="size" class="border border-gray-300 rounded-md">
                                <option value="">Kies uw maat</option>
                                <option value="xs">XS</option>
                                <option value="s">S</option>
                                <option value="m">M</option>
                                <option value="l">L</option>
                                <option value="xl">XL</option>
                            </select>
                        </div>
                        <!-- Add to cart form -->
                        <form id="addToCartForm-<?= $item['id'] ?>" action="/cart/add" method="post" class="mt-2">
                            <?= csrf() ?>
                            <input type="hidden" name="id" value="<?= $item['id'] ?>">
                            <input type="hidden" name="size" id="selectedSize-<?= $item['id'] ?>">
                            <input type="hidden" name="color" value="<?= htmlspecialchars($item['kleur'] ?? '-') ?>">
                            <input type="hidden" name="gender" value="<?= htmlspecialchars($item['geslacht'] ?? '-') ?>">
                            <button type="submit" class="bg-gray-500 text-white px-4 py-2 rounded">
                                <img src="/images/add-to-basket.png" alt="Add to Cart" class="inline-block w-6 h-6">
                            </button>
                        </form>
                        <p id="sizeError-<?= $item['id'] ?>" class="text-red-500 hidden">Kies een maat</p>
                    </div>
                    <script>
                        document.getElementById('addToCartForm-<?= $item['id'] ?>').addEventListener('submit', function(event) {
                            const size = document.getElementById('size-<?= $item['id'] ?>').value;
                            let hasError = false;
                            if (!size) {
                                event.preventDefault();
                                document.getElementById('sizeError-<?= $item['id'] ?>').classList.remove('hidden');
                                hasError = true;
                            } else {
                                document.getElementById('selectedSize-<?= $item['id'] ?>').value = size;
                                document.getElementById('sizeError-<?= $item['id'] ?>').classList.add('hidden');
                            }
                            if (hasError) {
                                event.preventDefault();
                            }
                        });


                        const rangevalue =
                            document.querySelector(".slider-container .price-slider");
                        const rangeInputvalue =
                            document.querySelectorAll(".range-input input");

                        // Set the price gap
                        let priceGap = 500;

                        // Adding event listners to price input elements
                        const priceInputvalue =
                            document.querySelectorAll(".price-input input");
                        for (let i = 0; i < priceInputvalue.length; i++) {
                            priceInputvalue[i].addEventListener("input", e => {

                                // Parse min and max values of the range input
                                let minp = parseInt(priceInputvalue[0].value);
                                let maxp = parseInt(priceInputvalue[1].value);
                                let diff = maxp - minp

                                if (minp < 0) {
                                    alert("minimum price cannot be less than 0");
                                    priceInputvalue[0].value = 0;
                                    minp = 0;
                                }

                                // Validate the input values
                                if (maxp > 10000) {
                                    alert("maximum price cannot be greater than 10000");
                                    priceInputvalue[1].value = 10000;
                                    maxp = 10000;
                                }

                                if (minp > maxp - priceGap) {
                                    priceInputvalue[0].value = maxp - priceGap;
                                    minp = maxp - priceGap;

                                    if (minp < 0) {
                                        priceInputvalue[0].value = 0;
                                        minp = 0;
                                    }
                                }

                                // Check if the price gap is met 
                                // and max price is within the range
                                if (diff >= priceGap && maxp <= rangeInputvalue[1].max) {
                                    if (e.target.className === "min-input") {
                                        rangeInputvalue[0].value = minp;
                                        let value1 = rangeInputvalue[0].max;
                                        rangevalue.style.left = `${(minp / value1) * 100}%`;
                                    } else {
                                        rangeInputvalue[1].value = maxp;
                                        let value2 = rangeInputvalue[1].max;
                                        rangevalue.style.right =
                                            `${100 - (maxp / value2) * 100}%`;
                                    }
                                }
                            });

                            // Add event listeners to range input elements
                            for (let i = 0; i < rangeInputvalue.length; i++) {
                                rangeInputvalue[i].addEventListener("input", e => {
                                    let minVal =
                                        parseInt(rangeInputvalue[0].value);
                                    let maxVal =
                                        parseInt(rangeInputvalue[1].value);


                                    let diff = maxVal - minVal

                                    // Check if the price gap is exceeded
                                    if (diff < priceGap) {

                                        // Check if the input is the min range input
                                        if (e.target.className === "min-range") {
                                            rangeInputvalue[0].value = maxVal - priceGap;
                                        } else {
                                            rangeInputvalue[1].value = minVal + priceGap;
                                        }
                                    } else {

                                        // Update price inputs and range progress
                                        priceInputvalue[0].value = minVal;
                                        priceInputvalue[1].value = maxVal;
                                        rangevalue.style.left =
                                            `${(minVal / rangeInputvalue[0].max) * 100}%`;
                                        rangevalue.style.right =
                                            `${100 - (maxVal / rangeInputvalue[1].max) * 100}%`;
                                    }
                                });
                            }
                        }
                    </script>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <!-- Paginatie -->
        <div class="flex justify-center mt-4">
            <?php if ($current_page > 1): ?>
                <a href="?page=<?= $current_page - 1 ?>" class="bg-blue-500 text-white px-3 py-1 rounded mr-2">Vorige</a>
            <?php endif; ?>
            <?php for ($i = max(1, $current_page - 2); $i <= min($current_page + 2, ceil($total_items / 15)); $i++): ?>
                <a href="?page=<?= $i ?>"
                    class="bg-blue-500 text-white px-3 py-1 rounded mx-1 <?= $i == $current_page ? 'bg-blue-700' : '' ?>"><?= $i ?></a>
            <?php endfor; ?>
            <?php if ($current_page < ceil($total_items / 15)): ?>
                <a href="?page=<?= $current_page + 1 ?>" class="bg-blue-500 text-white px-3 py-1 rounded ml-2">Volgende</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>

<script>
    document.getElementById('toggleFilters').addEventListener('click', function() {
        const filterForm = document.getElementById('filterForm');
        filterForm.classList.toggle('hidden');
    });
</script>

<?php
view("parts/footer");
?>