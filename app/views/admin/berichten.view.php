<?php
view("parts/header", ["title" => "Admin Berichten"]);
view("parts/navigatie-menu");

if (!isAdmin()) {
    echo "U heeft geen toegang tot deze pagina.";
    exit;
}

$messages = getMessages(); // Assume this function fetches messages from the database
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Berichten</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body>
    <div class="container mx-auto mt-8 sm:mx-10">
        <h1 class="text-3xl my-4">Berichten</h1>
        <?php if (empty($messages)): ?>
            <div class="bg-gray-100 border border-gray-400 text-gray-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">U heeft geen berichten.</span>
            </div>
        <?php else: ?>
            <ul class="space-y-4">
                <?php foreach ($messages as $message): ?>
                    <li class="p-4 bg-white shadow rounded-md">
                        <strong class="block text-lg">Gebruiker ID:</strong> <?= htmlspecialchars($message['klant_id'] ?? 'Anonieme gebruiker') ?><br>
                        <strong class="block text-lg">Naam:</strong> <?= htmlspecialchars($message['klant_naam'] ?? 'Onbekend') ?><br>
                        <strong class="block text-lg">Onderwerp:</strong> <?= htmlspecialchars($message['onderwerp']) ?><br>
                        <strong class="block text-lg">Bericht:</strong> <?= htmlspecialchars($message['bericht']) ?><br>
                        <em class="block text-sm text-gray-500">Gemaakt op: <?= htmlspecialchars($message['created_at']) ?></em>
                        <?php if (!empty($message['reacties'])): ?>
                            <?php foreach ($message['reacties'] as $reactie): ?>
                                <div class="mt-4 p-4 bg-gray-100 rounded-md">
                                    <strong class="block text-lg">Uw Reactie:</strong>
                                    <p><?= htmlspecialchars($reactie['reactie']) ?></p>
                                    <em class="block text-sm text-gray-500">Gereageerd op: <?= htmlspecialchars($reactie['created_at']) ?></em>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <form action="/admin/berichten-reply" method="post" class="mt-4">
                            <?= csrf() ?>
                            <input type="hidden" name="message_id" value="<?= htmlspecialchars($message['id']) ?>">
                            <div class="mb-4">
                                <label for="reply" class="block text-gray-700">Reactie</label>
                                <textarea id="reply" name="reply" placeholder="Typ je reactie hier" class="border border-gray-300 rounded-md p-2 w-full" required></textarea>
                            </div>
                            <div class="text-center">
                                <input type="submit" value="Verstuur" class="bg-[#52EBEB] text-white rounded-md px-4 py-2 hover:bg-[#3ACBCB] cursor-pointer">
                            </div>
                        </form>
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
</body>
</html>
