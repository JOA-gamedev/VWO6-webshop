<?php
view("parts/header", ['title' => 'items']);
view("parts/navigatie-menu");
?>
    <h1 class="text-3xl my-4">Items</h1>

    <p class="my-2">Hieronder een lijst met alle items</p><br>
    <ul class="ml-4">
        <!-- loop door alle items heen -->
        <?php foreach ($items as $item) : ?>
            <li><?= $item['id'] ?> -
                <?= htmlspecialchars($item['naam']) ?> -
                <?= htmlspecialchars($item['beschrijving']) ?> -
                <?= $item['prijs'] ?> -
                Link naar item:
                <a href="/items/<?= $item['id'] ?>" class="text-indigo-600">
                    <?= $item['naam'] ?>
                </a>
                <?php
                view('parts/delete-button', [
                    'action' => "/items/{$item['id']}",
                    'titel' => 'Delete',
                    'content' => 'Are you sure?',
                    'class' => 'inline-block'
                ]);
                ?>
            </li>
        <?php endforeach; ?>
    </ul>


<?php
view("parts/footer");