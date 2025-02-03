<?php
view("parts/header", ['title' => 'Kortingscodes']); // Laad de header
view("parts/navigatie-menu"); // Laad het navigatiemenu

?>

<div class="sm:mx-10">
    <h1 class="text-3xl my-4">Kortingscodes</h1>
</div>

<div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <table class="border-collapse border border-1 inline-block border-slate-700 rounded-lg">
        <thead>
            <tr>
                <th class="font-bold text-left p-2">Code</th>
                <th class="font-bold text-left p-2 border-collapse border border-1 border-slate-300 border-t-0">Percentage</th>
                <th class="font-bold text-left p-2 border-collapse border border-1 border-slate-300"></th>
            </tr>
        </thead>
        <tbody>
            <!-- kortingscodes in de tabel -->
            <?php foreach ($kortingscodes as $kortingscode): ?>
            <tr class="hover:bg-slate-100">
                <!-- UPDATE -->
                <form action="/kortingscodes/update" method="POST" class="">
                <?= csrf() ?>
                <input type="hidden" name="id" value="<?= $kortingscode['id'] ?>">

                    <td class="p-0 border-collapse border border-r-1 border-l-0 border-slate-300">
                        <input type="text" name="code" value="<?= htmlspecialchars($kortingscode['code']) ?>" class="border-0 bg-transparent">
                    </td>

                    <td class="p-0 pr-2 border-collapse border border-b-1 border-slate-300">
                        <input type="number" name="percentage" max="100" value="<?= htmlspecialchars($kortingscode['percentage']) ?>" class="border-0 bg-transparent text-right">
                        %
                    </td>

                    <td class="p-0 border-collapse border border-1 border-slate-300">
                        <button type="submit" class="bg-slate-300 hover:bg-slate-200 text-white font-bold py-2 px-4">Opslaan</button>
                    </td>

                </form>
                <!-- DELETE -->
                <td>
                    <form action="kortingscodes/delete" method="post" class="inline-block">
                        <?= csrf() ?>
                        <input type="hidden" name="id" value="<?= $kortingscode['id'] ?>">
                        <button type="submit" class="bg-red-200 hover:bg-red-100 text-red-700 font-bold py-2 px-4">Verwijderen</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>

            <!-- nieuwe rij toevoegen -->
             
            <tr id="newFormRow" class="rounded-lg hover:bg-slate-100">
                <form action="/kortingscodes/create" method="POST" class="">
                <?= csrf() ?>
                    <fieldset id="newFormFieldset" disabled class="disabled:opacity-50">
                    <td class="p-0 border-collapse border border-0 border-slate-300">
                        <input type="text" name="code" placeholder="Nieuwe code" class="border-0 bg-transparent rounded-bl-lg">
                    </td>
                
                    <td class="p-0 border-collapse border border-1 border-b-0 border-slate-300">
                        <input type="number" name="percentage" max="100" placeholder="Percentage" class="border-0 bg-transparent text-right ">
                        %
                    </td>
                
                    <td class="p-0 border-collapse border border-1 border-left-0 border-slate-300">
                        <button type="submit" class="bg-slate-300 hover:bg-slate-200 text-white font-bold py-2 px-4 rounded-br-lg">Opslaan</button>
                    </td>
                    </fieldset>
                </form>
            </tr>
            <script>
            document.getElementById('newFormRow').addEventListener('click', function() {
                document.getElementById('newFormFieldset').disabled = false;
            });
            </script>
        </tbody>
    </table>
</div>

<?php
view("parts/footer"); // Laad de footer (sluit body en html correct af)
?>
