<!-- home.php -->
<?php
view("parts/header", ['title' => 'Home']); // Laad de header
view("parts/topbar"); // Laad de topbar ticker
view("parts/navigatie-menu"); // Laad het navigatiemenu

$shop_name = "Jofi";
$headline = "De kleding winkel van morgen";
$subtext = "De stijl van de toekomst, vandaag. Stap binnen en ontdek een wereld waar stijl en innovatie samenkomen.";
$button_text = "Shop nu!";
$button_link = "/items/items-index";
?>

<section class="flex items-center justify-between p-12 bg-gray-100">
    <div class="max-w-lg">
        <h1 class="text-3xl font-bold text-black"><?php echo $headline; ?></h1>
        <p class="text-lg text-gray-700 mt-4"><?php echo $subtext; ?></p>
        <a href="<?php echo $button_link; ?>" class="inline-block mt-6 px-6 py-3 bg-white text-black font-bold rounded-full shadow-md hover:bg-gray-200">
            <?php echo $button_text; ?>
        </a>
    </div>
    <div class="w-80">
        <img src="images/section.png" alt="Hero afbeelding" class="w-full h-auto rounded-3xl">
    </div>
</section>

<h2 class="text-3xl my-4">Uitgelichte Producten</h2>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mx-4">
    <?php foreach ($items as $item) : ?>
        <?php if ($item['deleted_at'] === null): ?>
            <div class="mb-2 p-4 border rounded shadow-sm flex flex-col justify-between bg-white">
                <div>
                    <a href="/items/items-show/<?= htmlspecialchars($item['id']) ?>">
                        <img src="/images/<?= htmlspecialchars($item['afbeelding']) ?>" alt="<?= htmlspecialchars($item['naam']) ?>" class="w-full h-48 object-contain mb-2 rounded">
                    </a>
                    <a href="/items/items-show/<?= htmlspecialchars($item['id']) ?>" class="font-semibold">
                        <?= htmlspecialchars($item['naam']) ?>
                    </a><br>
                    <span class="text-gray-700"><?= htmlspecialchars($item['beschrijving']) ?></span><br>
                    <span class="text-gray-700">Kleur: <?= htmlspecialchars($item['kleur'] ?? '-') ?></span><br>
                    <span class="text-gray-700">Geslacht: <?= htmlspecialchars($item['geslacht'] ?? '-') ?></span><br>
                    <span class="text-green-600 font-bold">€<?= htmlspecialchars($item['prijs']) ?></span><br>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>

<?php
view("parts/footer"); // Laad de footer (sluit body en html correct af)
?>
