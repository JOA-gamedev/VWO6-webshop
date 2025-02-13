<?php
view("parts/header", ['title' => 'Producten']);
view("parts/navigatie-menu");
?>
<div class="flex flex-row justify-evenly gap-4">
    <!-- Filteropties -->
    <form id="filterForm" method="GET" action=""
        class="p-4 pt-20 flex flex-col sticky top-0 gap-10 w-1/4 h-screen justify-start hidden bg-gray-100 shadow-gray-400 shadow-md">
        <h2 class="text-2xl font-bold">Filters</h2>
        <div class="flex flex-wrap gap-2">
            <span class="w-full">Filter op kleur:</span>
            <style>
                label:has(input[type="radio"]:checked) {
                    outline: 2px solid black;
                }

                .radio_color input[type="radio"] {
                    display: none;
                }

                .radio_color {
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    padding: 0.5rem;
                    border-radius: 0.5rem;
                }

                .span_color {
                    display: inline-block;
                    width: 1.5rem;
                    height: 1.5rem;
                    border-radius: 0.5rem;
                }
            </style>
            <label class='radio_color'>
                <input type='radio' name='filter_color' value=''
                    <?= !isset($_GET['filter_color']) || $_GET['filter_color'] == '' ? 'checked' : '' ?>>
                <span class='span_color bg-transparent border border-black flex items-center justify-center material-icons'>clear
                </span>
            </label>
            <label class='radio_color'>
                <input type='radio' name='filter_color' value='bruin'
                    <?= isset($_GET['filter_color']) && $_GET['filter_color'] == 'bruin' ? 'checked' : '' ?>>
                <span class='span_color bg-yellow-700'></span>
            </label>
            <label class='radio_color'>
                <input type='radio' name='filter_color' value='roze'
                    <?= isset($_GET['filter_color']) && $_GET['filter_color'] == 'roze' ? 'checked' : '' ?>>
                <span class='span_color bg-rose-500'></span>
            </label>
            <label class='radio_color'>
                <input type='radio' name='filter_color' value='beige'
                    <?= isset($_GET['filter_color']) && $_GET['filter_color'] == 'beige' ? 'checked' : '' ?>>
                <span class='span_color' style='background-color: rgb(220,191,166);'></span>
            </label>
            <label class='radio_color'>
                <input type='radio' name='filter_color' value='grijs'
                    <?= isset($_GET['filter_color']) && $_GET['filter_color'] == 'grijs' ? 'checked' : '' ?>>
                <span class='span_color bg-gray-500'></span>
            </label>
            <label class='radio_color'>
                <input type='radio' name='filter_color' value='zwart'
                    <?= isset($_GET['filter_color']) && $_GET['filter_color'] == 'zwart' ? 'checked' : '' ?>>
                <span class='span_color bg-black'></span>
            </label>
            <label class='radio_color'>
                <input type='radio' name='filter_color' value='wit'
                    <?= isset($_GET['filter_color']) && $_GET['filter_color'] == 'wit' ? 'checked' : '' ?>>
                <span class='span_color bg-white'></span>
            </label>
            <label class='radio_color'>
                <input type='radio' name='filter_color' value='groen'
                    <?= isset($_GET['filter_color']) && $_GET['filter_color'] == 'groen' ? 'checked' : '' ?>>
                <span class='span_color' style='background-color: rgb(34,139,34);'></span>
            </label>
            <label class='radio_color'>
                <input type='radio' name='filter_color' value='gebroken wit'
                    <?= isset($_GET['filter_color']) && $_GET['filter_color'] == 'gebroken wit' ? 'checked' : '' ?>>
                <span class='span_color' style='background-color: rgb(238,235,227);'></span>
            </label>
            <label class='radio_color'>
                <input type='radio' name='filter_color' value='paars'
                    <?= isset($_GET['filter_color']) && $_GET['filter_color'] == 'paars' ? 'checked' : '' ?>>
                <span class='span_color' style='background-color: rgb(128, 0, 128);'></span>
            </label>            
            <label class='radio_color'>
                <input type='radio' name='filter_color' value='rood'
                    <?= isset($_GET['filter_color']) && $_GET['filter_color'] == 'rood' ? 'checked' : '' ?>>
                <span class='span_color' style='background-color: rgb(255, 0, 0);'></span>
            </label>        
            <label class='radio_color'>
                <input type='radio' name='filter_color' value='blauw'
                    <?= isset($_GET['filter_color']) && $_GET['filter_color'] == 'blauw' ? 'checked' : '' ?>>
                <span class='span_color' style='background-color: rgb(0, 0, 255);'></span>
            </label>
        </div>

        <?php
        // include the minmax-slider component and pass through the max price variable, and the left and right bounds
        view("parts/minmax-slider", [
            'max_price' => $max_price,
            'left_bound' => $_GET['filter_price_min'] ?? 1,
            'right_bound' => $_GET['filter_price_max'] ?? $max_price
        ]);
        ?>

        <select name="filter_gender" class="border p-1 rounded ">
            <option value="">Filter op geslacht</option>
            <option value="man"
                <?= isset($_GET['filter_gender']) && $_GET['filter_gender'] == 'man' ? 'selected' : '' ?>>
                Man
            </option>
            <option value="vrouw"
                <?= isset($_GET['filter_gender']) && $_GET['filter_gender'] == 'vrouw' ? 'selected' : '' ?>>
                Vrouw
            </option>
            <option value="unisex"
                <?= isset($_GET['filter_gender']) && $_GET['filter_gender'] == 'unisex' ? 'selected' : '' ?>>
                Unisex
            </option>
        </select>
        <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded ml-2">Filteren</button>
        <?php if (!empty($_GET['filter_color']) || !empty($_GET['filter_price_min']) || !empty($_GET['filter_price_max']) || !empty($_GET['filter_gender'])) : ?>
            <a href="/items/items-index" class="bg-red-500 text-center text-white px-2 py-1 rounded ml-2">Verwijder
                filters</a>
        <?php endif; ?>
    </form>

    <div class="container mx-auto p-4">
        <h1 class="text-3xl my-4 font-bold text-center">Producten</h1>

        <!-- Zoekformulier -->
        <!-- <form method="GET" action="" class="mb-4 flex justify-start">
            <input type="text" name="search" placeholder="Zoek producten..." class="border p-2 rounded w-1/3"
                value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded ml-2">Zoeken</button>
        </form> -->

        <!-- Filter knop -->
        <button id="toggleFilters" class="bg-blue-500 text-white px-3 py-1 rounded mb-4">Toon filters
            <span class="material-icons align-middle">filter_alt</span>
        </button>

        <!-- Sorteer menu -->
        <form method="GET" action="" class="mb-4 flex justify-end">
            <input type="hidden" name="search" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
            <input type="hidden" name="filter_color" value="<?= htmlspecialchars($_GET['filter_color'] ?? '') ?>">
            <input type="hidden" name="filter_price_min"
                value="<?= htmlspecialchars($_GET['filter_price_min'] ?? '1') ?>">
            <input type="hidden" name="filter_price_max"
                value="<?= htmlspecialchars($_GET['filter_price_max'] ?? '300') ?>">
            <input type="hidden" name="filter_gender" value="<?= htmlspecialchars($_GET['filter_gender'] ?? '') ?>">
            <select name="sort" class="border p-0.5 rounded w-1/6 ml-2">
                <option value="naam_asc" <?= isset($_GET['sort']) && $_GET['sort'] == 'naam_asc' ? 'selected' : '' ?>>
                    Naam
                    (A-Z)</option>
                <option value="naam_desc" <?= isset($_GET['sort']) && $_GET['sort'] == 'naam_desc' ? 'selected' : '' ?>>
                    Naam
                    (Z-A)</option>
                <option value="prijs_asc" <?= isset($_GET['sort']) && $_GET['sort'] == 'prijs_asc' ? 'selected' : '' ?>>
                    Prijs (€-€€€)</option>
                <option value="prijs_desc"
                    <?= isset($_GET['sort']) && $_GET['sort'] == 'prijs_desc' ? 'selected' : '' ?>>
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
                        <div class="mb-2 p-4 border rounded shadow-sm flex flex-col justify-between h-full">
                            <div>
                                <a href="/items/items-show/<?= htmlspecialchars($item['id']) ?>">
                                    <img src="/images/<?= htmlspecialchars($item['afbeelding']) ?>"
                                        alt="<?= htmlspecialchars($item['naam']) ?>"
                                        class="w-full h-48 object-contain mb-2 rounded">
                                </a>
                                <a href="/items/items-show/<?= htmlspecialchars($item['id']) ?>" class="font-semibold">
                                    <?= htmlspecialchars($item['naam']) ?>
                                </a><br>
                                <span class="text-gray-700"><?= htmlspecialchars($item['beschrijving']) ?></span><br>
                                <span class="text-gray-700">Kleur: <?= htmlspecialchars($item['kleur'] ?? '-') ?></span><br>
                                <span class="text-gray-700">Geslacht: <?= htmlspecialchars($item['geslacht'] ?? '-') ?></span><br>
                                <span class="text-green-600 font-bold">€<?= htmlspecialchars($item['prijs']) ?></span><br>
                                <label for="size-<?= $item['id'] ?>" class="block text-sm font-medium text-gray-700">Maat:</label>
                                <select id="size-<?= $item['id'] ?>" name="size" class="border border-gray-300 rounded-md">
                                    <option value="">Kies uw maat</option>
                                    <option value="xs">XS</option>
                                    <option value="s">S</option>
                                    <option value="m">M</option>
                                    <option value="l">L</option>
                                    <option value="xl">XL</option>
                                </select>
                                <!-- Display error message if no size is selected -->
                                <?php if (isset($_SESSION['error']) && $_SESSION['error_item_id'] == $item['id']): ?>
                                    <p class="text-red-500 text-sm mt-1"><?= htmlspecialchars($_SESSION['error']) ?></p>
                                    <?php unset($_SESSION['error'], $_SESSION['error_item_id']); ?>
                                <?php endif; ?>
                                <!-- Add to cart form -->
                                <form id="addToCartForm-<?= $item['id'] ?>" action="/cart/add" method="post" class="mt-2">
                                    <?= csrf() ?>
                                    <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                    <input type="hidden" name="size" id="selectedSize-<?= $item['id'] ?>">
                                    <button type="submit" class="bg-gray-500 text-white px-4 py-2 rounded">
                                        <img src="/images/cart1.png" alt="Add to Cart" class="inline-block w-6 h-6">
                                    </button>
                                </form>
                                <p id="sizeError-<?= $item['id'] ?>" class="text-red-500 hidden">Kies een maat</p>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <!-- Include pagination view -->
            <?php view('items/paging', ['total_pages' => $total_pages, 'current_page' => $current_page]); ?>

        <?php endif; ?>
    </div>
</div>

<script>
    document.getElementById('toggleFilters').addEventListener('click', function() {
        const filterForm = document.getElementById('filterForm');
        filterForm.classList.toggle('hidden');
    });

    <?php foreach ($items as $item): ?>
    document.getElementById('addToCartForm-<?= $item['id'] ?>').addEventListener('submit', function(event) {
        const size = document.getElementById('size-<?= $item['id'] ?>').value;
        if (!size) {
            event.preventDefault();
            document.getElementById('sizeError-<?= $item['id'] ?>').classList.remove('hidden');
        } else {
            document.getElementById('selectedSize-<?= $item['id'] ?>').value = size;
            document.getElementById('sizeError-<?= $item['id'] ?>').classList.add('hidden');
        }
    });
    <?php endforeach; ?>
</script>

<?php
view("parts/footer");
?>