<?php
view("parts/header", ['title' => 'about']);
view("parts/navigatie-menu");
?>
<div class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold leading-9 tracking-tight text-gray-900 text-center">Inloggen</h2>
        <?php if (isset($errors['login'])): ?>
            <p class="text-red-500 text-sm my-2 text-center"><?= $errors['login'] ?></p>
        <?php endif; ?>
        <form class="space-y-6 mt-6" action="/login" method="POST">
            <?= csrf() ?>
            <div class="relative">
                <input id="email" name="email" type="email" placeholder="E-mailaddres" autocomplete="email" required class="block w-full rounded-md border border-gray-300 py-1.5 text-gray-900 shadow-sm">
            </div>

            <div class="relative">
                <input id="password" name="password" type="password" placeholder="Wachtwoord" autocomplete="current-password" required class="block w-full rounded-md border border-gray-300 py-1.5 text-gray-900 shadow-sm">
                <!-- <div class="text-sm mt-2">
                    <a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500">Forgot password?</a>
                </div> -->
            </div>

            <div>
                <button type="submit" class="w-full rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus:ring-2 focus:ring-indigo-600">
                    Inloggen
                </button>
            </div>
        </form>
        <div class="text-sm mt-4 text-center">
            <p>Geen account? <a href="/registreer" class="font-semibold text-indigo-600 hover:text-indigo-500">Registreer hier</a></p>
        </div>
    </div>
</div>
<?php
view("parts/footer");
?>
