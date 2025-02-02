<?php
view("parts/header", ['title' => 'Kortingscodes']); // Laad de header
view("parts/navigatie-menu"); // Laad het navigatiemenu

?>

<div class="sm:mx-10">
    <h1 class="text-3xl my-4">Kortingscodes</h1>
</div>

<div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <table class="border border-slate-400 rounded-lg dark:border-slate-300 mt-6 w-full">
        <thead>
            <tr>
                <th class="font-bold text-left p-2">Code</th>
                <th class="font-bold text-left p-2 text-right">Percentage</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($kortingscodes as $kortingscode): ?>
            <tr>
                <form action="/kortingscodes/update" method="POST" class="flex space-x-2">
                <?= csrf() ?>
                    <td class="p-2">
                            <input type="hidden" name="id" value="<?= $kortingscode['id'] ?>">
                            <input type="text" name="code" value="<?= htmlspecialchars($kortingscode['code']) ?>" class="border p-2 rounded w-full">
                    </td>

                    <td class="p-2 text-right">
                            <input type="number" name="percentage" value="<?= htmlspecialchars($kortingscode['percentage']) ?>" class="border p-2 rounded w-full">
                    </td>

                    <td class="p-2 text-right">
                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Opslaan</button>
                    </td>
                </form>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php
view("parts/footer"); // Laad de footer (sluit body en html correct af)
?>
