<?php
view("parts/header", ['title' => 'registreer']);
view("parts/navigatie-menu");
?>
<div class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold leading-9 tracking-tight text-gray-900 text-center">Een account aanmaken</h2>
        <form action="/registreer-store" method="POST" class="space-y-6 mt-6">
            <?= csrf()?>
            <div class="relative">
                <input type="text" name="name" placeholder="Voor- en achternaam" class="block w-full rounded-md border border-gray-300 py-1.5 text-gray-900 shadow-sm placeholder-transparent peer">
                <label class="absolute left-2 top-2 text-sm text-gray-500 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 transition-all peer-focus:-top-2.5 peer-focus:text-sm peer-focus:text-gray-500">Voor- en achternaam</label>
                <?php if (errors('name')): ?>
                <p class="text-red-500 text-sm my-2"><?= errors('name') ?></p>
                <?php endif; ?>
            </div>
            
            <div class="relative">
                <input type="email" name="email" placeholder="E-mailadres" class="block w-full rounded-md border border-gray-300 py-1.5 text-gray-900 shadow-sm placeholder-transparent peer">
                <label class="absolute left-2 top-2 text-sm text-gray-500 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 transition-all peer-focus:-top-2.5 peer-focus:text-sm peer-focus:text-gray-500">E-mailadres</label>
                <?php if (errors('email')): ?>
                <p class="text-red-500 text-sm my-2"><?= errors('email') ?></p>
                <?php endif; ?>
            </div>
            
            <div class="relative">
                <input type="password" name="password" placeholder="Wachtwoord" class="block w-full rounded-md border border-gray-300 py-1.5 text-gray-900 shadow-sm placeholder-transparent peer">
                <label class="absolute left-2 top-2 text-sm text-gray-500 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 transition-all peer-focus:-top-2.5 peer-focus:text-sm peer-focus:text-gray-500">Wachtwoord</label>
                <?php if (errors('password')): ?>
                <p class="text-red-500 text-sm my-2"><?= errors('password') ?></p>
                <?php endif; ?>
            </div>
            
            <div>
                <button type="submit" class="w-full rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus:ring-2 focus:ring-indigo-600">
                    Registreren
                </button>
            </div>
        </form>
    </div>
</div>
<?php
view("parts/footer");
?>