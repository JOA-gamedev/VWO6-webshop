<?php
view("parts/header", ['title' => 'Bestelstatus']);
view("parts/navigatie-menu");
?>
<div class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="max-w-md mx-auto mt-10 p-6 bg-white rounded-lg shadow-md text-center">
        <h1 class="text-2xl font-bold mb-4">Uw bestelling is</h1>
        <p class="text-lg text-gray-700"><?php echo htmlspecialchars($orderStatus); ?></p>
    </div>
</div>
<?php
view("parts/footer");
?>