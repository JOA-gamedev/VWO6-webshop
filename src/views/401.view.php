<?php
view("parts/header", ['title' => '401']);
view("parts/navigatie-menu");
?>

<div class="mx-auto max-w-7xl py-20 sm:px-6 lg:px:8">
    <h1 class="text-2xl font-bold  mb-4">401 Geen toegang: <?= $error ?? '' ?></h1>
    <p class="mt-2">
        <a href="/" class="text-indigo-800 hover:text-indigo-600">Ga terug naar home</a>
    </p>
</div>