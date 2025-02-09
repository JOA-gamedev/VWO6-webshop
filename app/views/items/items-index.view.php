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

    <!-- Filteropties -->
    <form id="filterForm" method="GET" action=""
        class="mb-4 flex flex-wrap justify-start hidden bg-gray-100 p-4 rounded shadow">
        <select name="filter_color" class="border p-1 rounded w-1/5 ml-2">
            <option value="">Filter op kleur</option>
            <option value="bruin"
                <?= isset($_GET['filter_color']) && $_GET['filter_color'] == 'bruin' ? 'selected' : '' ?>>Bruin</option>
            <option value="roze"
                <?= isset($_GET['filter_color']) && $_GET['filter_color'] == 'roze' ? 'selected' : '' ?>>Roze</option>
            <option value="beige"
                <?= isset($_GET['filter_color']) && $_GET['filter_color'] == 'beige' ? 'selected' : '' ?>>Beige</option>
            <option value="grijs"
                <?= isset($_GET['filter_color']) && $_GET['filter_color'] == 'grijs' ? 'selected' : '' ?>>Grijs</option>
            <option value="zwart"
                <?= isset($_GET['filter_color']) && $_GET['filter_color'] == 'zwart' ? 'selected' : '' ?>>Zwart</option>
            <option value="wit" <?= isset($_GET['filter_color']) && $_GET['filter_color'] == 'wit' ? 'selected' : '' ?>>
                Wit</option>
        </select>


        <div class=" main">
            <div class="custom-wrapper">
                <div class="price-input-container">
                    <div class="price-input">
                        <div class="price-field flex items-center mb-4">
                            <span class="mr-2 text-lg">Minimum Price</span>
                            <input type="number" class="min-input flex-1 h-10 text-base rounded-lg text-center border-0 bg-gray-200"
                                value="<?= htmlspecialchars($_GET['filter_price_min'] ?? '1') ?>">
                        </div>
                        <div class="price-field flex items-center mb-4">
                            <span class="mr-2 text-lg">Maximum Price</span>
                            <input type="number" class="max-input flex-1 h-10 text-base rounded-lg text-center border-0 bg-gray-200"
                                value="<?= htmlspecialchars($_GET['filter_price_max'] ?? '300') ?>">
                        </div>
                    </div>
                    <div class="slider-container relative h-2 bg-gray-200 rounded ml-2 mr-2">
                        <div class="price-slider absolute h-full bg-green-600 rounded"></div>
                    </div>
                </div>

                <!-- Slider -->
                <div class="range-input relative mt-4 ml-2 mr-2">
                    <input type="range" name="filter_price_min" class="min-range absolute w-full h-2 bg-transparent appearance-none pointer-events-auto"
                        min="1" max="300" value="<?= htmlspecialchars($_GET['filter_price_min'] ?? '1') ?>" step="1">
                    <input type="range" name="filter_price_max" class="max-range absolute w-full h-2 bg-transparent appearance-none pointer-events-auto"
                        min="1" max="300" value="<?= htmlspecialchars($_GET['filter_price_max'] ?? '300') ?>" step="1">
                </div>
            </div>
        </div>

        <select name="filter_gender" class="border p-1 rounded w-1/5 ml-2">
            <option value="">Filter op geslacht</option>
            <option value="man"
                <?= isset($_GET['filter_gender']) && $_GET['filter_gender'] == 'male' ? 'selected' : '' ?>>Man
            </option>
            <option value="vrouw"
                <?= isset($_GET['filter_gender']) && $_GET['filter_gender'] == 'female' ? 'selected' : '' ?>>
                Vrouw
            </option>
            <option value="unisex"
                <?= isset($_GET['filter_gender']) && $_GET['filter_gender'] == 'unisex' ? 'selected' : '' ?>>
                Unisex
            </option>
        </select>
        <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded ml-2">Filteren</button>
        <a href="/items/items-index" class="bg-red-500 text-white px-2 py-1 rounded ml-2">Verwijder filters</a>
    </form>

    <!-- Sorteer menu -->
    <form method="GET" action="" class="mb-4 flex justify-end">
        <input type="hidden" name="search" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
        <input type="hidden" name="filter_color" value="<?= htmlspecialchars($_GET['filter_color'] ?? '') ?>">
        <input type="hidden" name="filter_price_min" value="<?= htmlspecialchars($_GET['filter_price_min'] ?? '1') ?>">
        <input type="hidden" name="filter_price_max" value="<?= htmlspecialchars($_GET['filter_price_max'] ?? '300') ?>">
        <input type="hidden" name="filter_gender" value="<?= htmlspecialchars($_GET['filter_gender'] ?? '') ?>">
        <select name="sort" class="border p-0.5 rounded w-1/6 ml-2">
            <option value="naam_asc" <?= isset($_GET['sort']) && $_GET['sort'] == 'naam_asc' ? 'selected' : '' ?>>Naam
                (A-Z)</option>
            <option value="naam_desc" <?= isset($_GET['sort']) && $_GET['sort'] == 'naam_desc' ? 'selected' : '' ?>>Naam
                (Z-A)</option>
            <option value="prijs_asc" <?= isset($_GET['sort']) && $_GET['sort'] == 'prijs_asc' ? 'selected' : '' ?>>
                Prijs (€-€€€)</option>
            <option value="prijs_desc" <?= isset($_GET['sort']) && $_GET['sort'] == 'prijs_desc' ? 'selected' : '' ?>>
                Prijs (€€€-€)</option>
        </select>
        <button type="submit" class="bg-blue-500 text-white px-1 py-0.5 rounded ml-2">Sorteren</button>
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
                        document.addEventListener('DOMContentLoaded', function() {
                            // Function to initialize the slider values and styles
                            function initializeSlider() {
                                const rangevalue = document.querySelector(".slider-container .price-slider");
                                const rangeInputvalue = document.querySelectorAll(".range-input input");
                                const priceInputvalue = document.querySelectorAll(".price-input input");

                                let minVal = parseInt(rangeInputvalue[0].value);
                                let maxVal = parseInt(rangeInputvalue[1].value);

                                // Update price inputs and range progress
                                priceInputvalue[0].value = minVal;
                                priceInputvalue[1].value = maxVal;
                                rangevalue.style.left = `${(minVal / rangeInputvalue[0].max) * 100}%`;
                                rangevalue.style.right = `${100 - (maxVal / rangeInputvalue[1].max) * 100}%`;
                            }

                            // Call the initialize function when the page loads
                            initializeSlider();

                            document.getElementById('addToCartForm-<?= $item['id'] ?>').addEventListener('submit', function(
                                event) {
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

                            const rangevalue = document.querySelector(".slider-container .price-slider");
                            const rangeInputvalue = document.querySelectorAll(".range-input input");

                            // Set the price gap
                            let priceGap = 20;

                            // Adding event listeners to price input elements
                            const priceInputvalue = document.querySelectorAll(".price-input input");
                            for (let i = 0; i < priceInputvalue.length; i++) {
                                priceInputvalue[i].addEventListener("input", e => {
                                    // Parse min and max values of the range input
                                    let minp = parseInt(priceInputvalue[0].value);
                                    let maxp = parseInt(priceInputvalue[1].value);
                                    let diff = maxp - minp;

                                    if (minp < 0) {
                                        alert("minimum price cannot be less than 0");
                                        priceInputvalue[0].value = 0;
                                        minp = 0;
                                    }

                                    // Validate the input values
                                    if (maxp > 300) {
                                        alert("maximum price cannot be greater than 300");
                                        priceInputvalue[1].value = 300;
                                        maxp = 300;
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
                                            rangevalue.style.right = `${100 - (maxp / value2) * 100}%`;
                                        }
                                    }
                                });
                            }

                            // Add event listeners to range input elements
                            for (let i = 0; i < rangeInputvalue.length; i++) {
                                rangeInputvalue[i].addEventListener("input", e => {
                                    let minVal = parseInt(rangeInputvalue[0].value);
                                    let maxVal = parseInt(rangeInputvalue[1].value);
                                    let diff = maxVal - minVal;

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
                                        rangevalue.style.left = `${(minVal / rangeInputvalue[0].max) * 100}%`;
                                        rangevalue.style.right = `${100 - (maxVal / rangeInputvalue[1].max) * 100}%`;
                                    }
                                });
                            }
                        });
                    </script>
                <?php endif; ?>
            <?php endforeach; ?>
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