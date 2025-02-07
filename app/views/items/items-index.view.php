<?php
view("parts/header", ['title' => 'Producten']);
view("parts/navigatie-menu");
?>
<div class="container mx-auto p-4">
    <h1 class="text-3xl my-4 font-bold text-center">Producten</h1>

    <!-- Zoekformulier -->
    <form method="GET" action="" class="mb-4 flex justify-start">
        <input type="text" name="search" placeholder="Zoek producten..." class="border p-1 rounded w-1/5" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
        <button type="submit" class="bg-blue-500 text-white px-3 py-0.5 rounded ml-2">Zoeken</button>
    </form>

    <!-- Filter knop -->
    <button id="toggleFilters" class="bg-blue-500 text-white px-2 py-0.5 rounded mb-4">Toon filters</button>

    <!-- Filteropties -->
    <form id="filterForm" method="GET" action="" class="mb-4 flex flex-wrap justify-start hidden bg-gray-100 p-4 rounded shadow">
        <select name="filter_color" class="border p-1 rounded w-1/4 ml-2">
            <option value="">Filter op kleur</option>
            <option value="bruin" <?= isset($_GET['filter_color']) && $_GET['filter_color'] == 'bruin' ? 'selected' : '' ?>>Bruin</option>
            <option value="roze" <?= isset($_GET['filter_color']) && $_GET['filter_color'] == 'roze' ? 'selected' : '' ?>>Roze</option>
            <option value="beige" <?= isset($_GET['filter_color']) && $_GET['filter_color'] == 'beige' ? 'selected' : '' ?>>Beige</option>
            <option value="grijs" <?= isset($_GET['filter_color']) && $_GET['filter_color'] == 'grijs' ? 'selected' : '' ?>>Grijs</option>
            <option value="zwart" <?= isset($_GET['filter_color']) && $_GET['filter_color'] == 'zwart' ? 'selected' : '' ?>>Zwart</option>
            <option value="wit" <?= isset($_GET['filter_color']) && $_GET['filter_color'] == 'wit' ? 'selected' : '' ?>>Wit</option>
        </select>
        <select name="filter_price" class="border p-1 rounded w-1/4 ml-2">
            <option value="">Filter op prijs</option>
            <option value="0-50" <?= isset($_GET['filter_price']) && $_GET['filter_price'] == '0-50' ? 'selected' : '' ?>>0 - 50</option>
            <option value="51-100" <?= isset($_GET['filter_price']) && $_GET['filter_price'] == '51-100' ? 'selected' : '' ?>>51 - 100</option>
            <option value="101-200" <?= isset($_GET['filter_price']) && $_GET['filter_price'] == '101-200' ? 'selected' : '' ?>>101 - 200</option>
        </select>
        <select name="filter_gender" class="border p-1 rounded w-1/4 ml-2">
            <option value="">Filter op geslacht</option>
            <option value="male" <?= isset($_GET['filter_gender']) && $_GET['filter_gender'] == 'male' ? 'selected' : '' ?>>Man</option>
            <option value="female" <?= isset($_GET['filter_gender']) && $_GET['filter_gender'] == 'female' ? 'selected' : '' ?>>Vrouw</option>
            <option value="unisex" <?= isset($_GET['filter_gender']) && $_GET['filter_gender'] == 'unisex' ? 'selected' : '' ?>>Unisex</option>
        </select>
        <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded ml-2">Filteren</button>
        <a href="/items/items-index" class="bg-red-500 text-white px-2 py-1 rounded ml-2">Verwijder filters</a>
    </form>

    <!-- Sorteer menu -->
    <form method="GET" action="" class="mb-4 flex justify-end">
        <select name="sort" class="border p-0.5 rounded w-1/6 ml-2">
            <option value="naam_asc" <?= isset($_GET['sort']) && $_GET['sort'] == 'naam_asc' ? 'selected' : '' ?>>Naam (A-Z)</option>
            <option value="naam_desc" <?= isset($_GET['sort']) && $_GET['sort'] == 'naam_desc' ? 'selected' : '' ?>>Naam (Z-A)</option>
            <option value="prijs_asc" <?= isset($_GET['sort']) && $_GET['sort'] == 'prijs_asc' ? 'selected' : '' ?>>Prijs (€-€€€)</option>
            <option value="prijs_desc" <?= isset($_GET['sort']) && $_GET['sort'] == 'prijs_desc' ? 'selected' : '' ?>>Prijs (€€€-€)</option>
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
            </script>
            <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <!-- Paginatie -->
        <div class="flex justify-center mt-4">
            <?php
            $queryParams = $_GET;
            if ($current_page > 1):
                $queryParams['page'] = $current_page - 1;
            ?>
                <a href="?<?= http_build_query($queryParams) ?>" class="bg-blue-500 text-white px-3 py-1 rounded mr-2">Vorige</a>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $total_pages; $i++):
                $queryParams['page'] = $i;
            ?>
                <a href="?<?= http_build_query($queryParams) ?>" class="bg-blue-500 text-white px-3 py-1 rounded mx-1 <?= $i == $current_page ? 'bg-blue-700' : '' ?>"><?= $i ?></a>
            <?php endfor; ?>
            <?php
            if ($current_page < $total_pages):
                $queryParams['page'] = $current_page + 1;
            ?>
                <a href="?<?= http_build_query($queryParams) ?>" class="bg-blue-500 text-white px-3 py-1 rounded ml-2">Volgende</a>
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