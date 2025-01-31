<?php
view("parts/header", ['title' => 'Admin dashboard']);
view("parts/navigatie-menu");

?>
    <div class="sm:mx-10">
        <h1 class="text-3xl my-4">Dashboard</h1>

        <p class="my-4">Hier komen alle admin functies</p>
        
        <a href="productbeheer" class="inline-block bg-indigo-600 text-white py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Productbeheer</a>
    </div>

<?php
view("parts/footer");
