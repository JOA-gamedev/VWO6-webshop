<?php
view("parts/header", ["title" => "Mijn Berichten"]);
view("parts/navigatie-menu");

$messages = getCustomerMessages(); // Assume this function fetches messages for the logged-in customer
?>
<div class="sm:mx-10">
    <h1 class="text-3xl my-4">Mijn Berichten</h1>
    <div class="flex justify-center mb-4">
        <a href="/contact" class="inline-block px-4 py-2 bg-[#52EBEB] text-white rounded-md hover:bg-[#3BBDBD]">Nieuw
            bericht</a>
    </div>
    <?php if (empty($messages)): ?>
    <div class="bg-gray-100 border border-gray-400 text-gray-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">U heeft geen berichten.</span>
    </div>
    <?php else: ?>
    <ul class="space-y-4">
        <?php foreach ($messages as $message): ?>
        <li class="p-4 bg-white shadow rounded-md">
            <strong class="block text-lg">Onderwerp:</strong> <?= htmlspecialchars($message['onderwerp']) ?><br>
            <strong class="block text-lg">Bericht:</strong> <?= htmlspecialchars($message['bericht']) ?><br>
            <em class="block text-sm text-gray-500">Gemaakt op: <?= htmlspecialchars($message['created_at']) ?></em>
            <?php if (!empty($message['reacties'])): ?>
            <?php foreach ($message['reacties'] as $reactie): ?>
            <div class="mt-4 p-4 bg-gray-100 rounded-md">
                <strong class="block text-lg">Reactie van Admin:</strong>
                <p><?= htmlspecialchars($reactie['reactie']) ?></p>
                <em class="block text-sm text-gray-500">Gereageerd op:
                    <?= htmlspecialchars($reactie['created_at']) ?></em>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
</div>

<?php view("parts/footer"); ?>

<script>
function closePopup() {
    document.querySelector('.fixed').classList.add('hidden');
}
</script>