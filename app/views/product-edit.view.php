<?php

view('parts/header', ['title' => 'Klant gegevens aanpassen']); 
view('parts/navigatie-menu');  
?>
    <form method="post" action="/profiel-edit/<?= $klant['id'] ?>">
    
        <?= csrf(); ?>
        Volledige naam:
        <input type="text" name="name" value="<?= $klant['name'] ?>" required><br>
        <?php if (isset($errors['name'])): ?>
            <p class="text-red-500 text-sm my-2"><?= $errors['name'] ?></p>
        <?php endif; ?>

       Achternaam:
        <input type="text" name="email" value="<?= $klant['email'] ?>" required><br>
        <?php if (isset($errors['email'])): ?>
            <p class="text-red-500 text-sm my-2"><?= $errors['email'] ?></p>
        <?php endif; ?>
       </form>


<?php
view('parts/footer'); 