<?php
view("parts/header", ["title" => "Bestellingen beheren"]);
view("parts/navigatie-menu");
?>

<div class="sm:mx-10">
    <h1 class="text-3xl my-4">Bestellingen beheren</h1>
</div>

<div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <table class="border border-slate-400 dark:border-slate-300 mt-6 w-full">
        <thead>
            <tr>
                <th class="font-bold text-left p-2">Order ID</th>
                <th class="font-bold text-left p-2">Klantnaam</th>
                <th class="font-bold text-left p-2">Producten</th>
                <th class="font-bold text-left p-2">Totaalprijs</th>
                <th class="font-bold text-left p-2">Status</th>
                <th class="font-bold text-left p-2">Acties</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr class="bg-slate-200 hover:bg-slate-400 border border-slate-300">
                    <td class="p-4"><?= htmlspecialchars($order['id']) ?></td>
                    <td class="p-4"><?= htmlspecialchars($order['klantnaam']) ?></td>
                    <td class="p-4"><?= htmlspecialchars($order['producten']) ?></td>
                    <td class="p-4"><?= htmlspecialchars($order['totaalprijs']) ?></td>
                    <td class="p-4"><?= htmlspecialchars($order['status']) ?></td>
                    <td class="p-4">
                        <a href="/admin/orders-edit?id=<?= $order['id'] ?>" class="text-indigo-600 hover:text-indigo-900">Wijzigen</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php
view("parts/footer");
?>
