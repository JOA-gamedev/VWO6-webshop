<?php
view("parts/header", ["title" => "Mijn Berichten"]);
view("parts/navigatie-menu");

$messages = getCustomerMessages(); // Assume this function fetches messages for the logged-in customer
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mijn Berichten</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body>
    <div class="container mx-auto mt-8">
        <h1 class="text-2xl font-bold mb-4">Mijn Berichten</h1>
        <?php if (empty($messages)): ?>
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                    <p class="mb-4">U heeft geen berichten.</p>
                    <button onclick="closePopup()" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Sluiten</button>
                </div>
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
                                    <em class="block text-sm text-gray-500">Gereageerd op: <?= htmlspecialchars($reactie['created_at']) ?></em>
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
</body>
</html>
