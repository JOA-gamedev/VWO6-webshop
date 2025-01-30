<!-- home.php -->
<?php
view("parts/header", ['title' => 'Home']); // Laad de header
view("parts/navigatie-menu"); // Laad het navigatiemenu
?>

<div class="sm:mx-10">
    <h1 class="text-3xl my-4">Kledingwinkel</h1>
</div>

<?php
view("parts/footer"); // Laad de footer (sluit body en html correct af)
?>
