<?php
view("parts/header", ['title' => 'product-pagina']);
view("parts/navigatie-menu");
?>
    <div class="sm:mx-10">
        <h1 class="text-3xl my-4">Productpagina</h1>

        <div class="border border-1 rounded p-4 bg-gray-50 my-4">
            <form action="product-edit" method="post">
                <?= csrf() ?>
                <input type="text" name="naam" value="<?= $product["naam"]?>">
                <input type="text" name="prijs" value="<?= $product["prijs"]?>">
                <textarea name="beschrijving"><?= $product["beschrijving"]?></textarea>
                <input type="submit" value="Wijzigingen Opslaan">
            </form>
        </div>
    </div>
<?php
view("parts/footer");