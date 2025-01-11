<?php
view("parts/header", ['title' => 'product-pagina']);
view("parts/navigatie-menu");
?>
    <div class="sm:mx-10">
        <h1 class="text-3xl my-4">Productpagina</h1>

        <div class="border border-1 rounded p-4 bg-gray-50 my-4">
            <form method="POST" action="/product-update">

                <?= csrf(); ?>
                
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($product['id']); ?>">
                
                <label for="naam">Naam</label>
                <input type="text" name="naam" value="<?php echo htmlspecialchars($product['naam']); ?>" required>

                <label for="prijs">Prijs</label>
                <input type="number" name="prijs" value="<?php echo htmlspecialchars($product['prijs']); ?>" required>

                <label for="beschrijving">Beschrijving</label>
                <textarea name="beschrijving" required><?php echo htmlspecialchars($product['beschrijving']); ?></textarea>
                
                <button type="submit">Opslaan</button>
            </form>
        </div>
    </div>
<?php
view("parts/footer");