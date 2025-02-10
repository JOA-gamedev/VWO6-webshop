<?php
view("parts/header", ['title' => 'Kortingscodes']); // Laad de header
view("parts/navigatie-menu"); // Laad het navigatiemenu
?>

<div class="sm:mx-10">
    <h1 class="text-3xl my-4">Kortingscodes</h1>
    <a href="/admin-dashboard" class="bg-gray-500 text-white px-2 py-1 rounded">Terug</a>
</div>

<div class="w-fit mx-auto bg-[#121212] p-8 rounded-lg">
    <table class="shadow-lg ">
        <thead class="bg-[#202020] text-white">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Id</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Code</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Percentage</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody class="bg-[#121212] text-white">
            <!-- kortingscodes in de tabel -->
            <?php foreach ($kortingscodes as $kortingscode): ?>
                <tr class="">
                    <!-- UPDATE -->
                    <form action=" /kortingscodes/update" method="POST">
                        <?= csrf() ?>
                        <input type="hidden" name="id" value="<?= $kortingscode['id'] ?>">

                        <td class="text-white  text-center">
                            <?= $kortingscode['id'] ?>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="standard-input">
                                <input type="text" name="code" value="<?= htmlspecialchars($kortingscode['code']) ?>"
                                    placeholder=" ">
                                <label for="code">Code</label>
                                <span class="underline"></span>
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="standard-input">
                                <input type="number" name="percentage" max="100"
                                    value="<?= htmlspecialchars($kortingscode['percentage']) ?>" placeholder=" ">
                                <label for="percentage">Percentage</label>
                                <span class="underline"></span>
                                %
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 rounded">Opslaan</button>
                        </td>

                    </form>
                    <!-- DELETE -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <form action="kortingscodes/delete" method="post">
                            <?= csrf() ?>
                            <input type="hidden" name="id" value="<?= $kortingscode['id'] ?>">
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-400 text-white font-bold py-2 px-4 rounded">Verwijderen</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>

            <!-- nieuwe rij toevoegen -->
        </tbody>
    </table>

</div>

<div class="w-fit mx-auto mt-4 bg-[#121212] p-8 rounded-lg shadow-lg">
    <form action="/kortingscodes/create" method="POST">
        <?= csrf() ?>

        <div class="flex flex-row gap-8">
            <div class="outlined-input">
                <input type="text" name="code" placeholder=" ">
                <label for="code">Code</label>
                <span class="underline"></span>
            </div>


            <div class="outlined-input">
                <input type="number" name="percentage" max=100 placeholder=" ">
                <label for="percentage">Percentage</label>
                <span class="underline"></span>
                %
            </div>



            <button type="submit"
                class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 rounded">Opslaan</button>
        </div>

    </form>

</div>

<?php
view("parts/footer"); // Laad de footer (sluit body en html correct af)
?>