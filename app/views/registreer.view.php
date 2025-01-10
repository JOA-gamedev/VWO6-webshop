<?php
view("parts/header", ['title' => 'registreer']);
view("parts/navigatie-menu");
 
?>
<div class="sm:mx-10">
    <h1 class="text-3xl my-4">registreer</h1>
    <form action="/registreer-store" method="POST">
        <?= csrf()?>
        Voor- en achternaam:<br>
        <input type="text" name="name" placeholder="naam">
        <?php if (errors('name')): ?>
        <p class="text-red-500 text-sm my-2"><?= errors('name') ?></p>
        <?php endif; ?>
        <br><br>
        E-mailadres:<br>
        <input type="email" name="email" placeholder="E-mailadres">
        <?php if (errors('email')): ?>
        <p class="text-red-500 text-sm my-2"><?= errors('email') ?></p>
        <?php endif; ?><br><br>
        Wachtwoord:<br>
        <input type="password" name="password" placeholder="Wachtwoord">
        <?php if (errors('password')): ?>
        <p class="text-red-500 text-sm my-2"><?= errors('password') ?></p>
        <?php endif; ?>
        <br><br>
        <input type="submit" value="Aanmaken"
            class="flex justify rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
    </form>
 
 
 
    <?php
view("parts/footer");