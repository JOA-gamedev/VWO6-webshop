<?php
view("parts/header", ['title' => 'Admin dashboard']);
view("parts/navigatie-menu");

?>
    <div class="sm:mx-10">
        <h1 class="text-3xl my-4">Dashboard</h1>

        <p class="my-4">hier komen alle admin functies
        </p>
        
        <a href="productbeheer">productbeheer</a>


<?php
view("parts/footer");
