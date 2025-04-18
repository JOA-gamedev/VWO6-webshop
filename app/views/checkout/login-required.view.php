<?php
view("parts/header", ['title' => 'Login Required']);
view("parts/navigatie-menu");
?>
<div class="container mx-auto p-4">
    <a href="javascript:history.back()" class="bg-gray-500 text-white px-2 py-1 rounded mb-4 inline-block">Terug</a>
    <h1 class="text-3xl my-4 font-bold text-center">Login vereist</h1>
    <p class="text-center text-lg mb-4">U moet inloggen om verder te gaan met uw bestelling.</p>
    <div class="flex justify-center space-x-4">
        <a href="/login" class="bg-[#52EBEB] text-white px-4 py-2 rounded">Login</a>
        <a href="/registreer" class="bg-[#52EBEB] hover:bg-[#3BBDBD] text-white px-4 py-2 rounded" onclick="sessionStorage.setItem('redirect_to_cart', 'true')">Registreren</a>
    </div>
</div>
<?php
view("parts/footer");
?>
