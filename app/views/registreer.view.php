<?php
view("parts/header", ['title' => 'Registreer']);
view("parts/navigatie-menu");
?>
<div class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold leading-9 tracking-tight text-gray-900 text-center">Een account aanmaken</h2>
        <form action="/registreer-store" method="POST" class="space-y-6 mt-6">
            <?= csrf()?>
            <?php if (isset($errors) && !empty($errors)): ?>
                <div class="text-red-500 text-sm my-2">
                    <?php foreach ($errors as $error): ?>
                        <p><?= $error ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <div class="relative">
                <input type="text" name="name" placeholder="Voor- en achternaam" value="<?= htmlspecialchars($_POST['name'] ?? '', ENT_QUOTES) ?>" class="block w-full rounded-md border border-gray-300 py-1.5 text-gray-900 shadow-sm">
                <?php if (errors('name')): ?>
                <p class="text-red-500 text-sm my-2"><?= errors('name') ?></p>
                <?php endif; ?>
            </div>
            
            <div class="relative">
                <input type="email" name="email" placeholder="E-mailadres" value="<?= htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES) ?>" class="block w-full rounded-md border border-gray-300 py-1.5 text-gray-900 shadow-sm">
                <?php if (errors('email')): ?>
                <p class="text-red-500 text-sm my-2"><?= errors('email') ?></p>
                <?php endif; ?>
            </div>
            
            <div class="relative">
                <input type="password" name="password" placeholder="Wachtwoord" class="block w-full rounded-md border border-gray-300 py-1.5 text-gray-900 shadow-sm">
                <?php if (errors('password')): ?>
                <p class="text-red-500 text-sm my-2"><?= errors('password') ?></p>
                <?php endif; ?>
            </div>

            <div class="relative">
                <input type="text" name="straat" placeholder="Straat" value="<?= htmlspecialchars($_POST['straat'] ?? '', ENT_QUOTES) ?>" class="block w-full rounded-md border border-gray-300 py-1.5 text-gray-900 shadow-sm">
                <?php if (errors('straat')): ?>
                <p class="text-red-500 text-sm my-2"><?= errors('straat') ?></p>
                <?php endif; ?>
            </div>
            
            <div class="relative">
                <input type="text" name="huisnr" placeholder="Huisnummer" value="<?= htmlspecialchars($_POST['huisnr'] ?? '', ENT_QUOTES) ?>" class="block w-full rounded-md border border-gray-300 py-1.5 text-gray-900 shadow-sm">
                <?php if (errors('huisnr')): ?>
                <p class="text-red-500 text-sm my-2"><?= errors('huisnr') ?></p>
                <?php endif; ?>
            </div>
            
            <div class="relative">
                <input type="text" name="postcode" placeholder="Postcode" value="<?= htmlspecialchars($_POST['postcode'] ?? '', ENT_QUOTES) ?>" class="block w-full rounded-md border border-gray-300 py-1.5 text-gray-900 shadow-sm">
                <?php if (errors('postcode')): ?>
                <p class="text-red-500 text-sm my-2"><?= errors('postcode') ?></p>
                <?php endif; ?>
            </div>
            
            <div class="relative">
                <input type="text" name="plaats" placeholder="Plaats" value="<?= htmlspecialchars($_POST['plaats'] ?? '', ENT_QUOTES) ?>" class="block w-full rounded-md border border-gray-300 py-1.5 text-gray-900 shadow-sm">
                <?php if (errors('plaats')): ?>
                <p class="text-red-500 text-sm my-2"><?= errors('plaats') ?></p>
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