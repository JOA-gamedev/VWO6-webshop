<?php
function isAdmin() {
    // Implement your logic to check if the user is an admin
    return isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin';
}
?>
<nav class="bg-gray-800 p-4">
    <div class="container mx-auto flex justify-between items-center">
        <div class="flex items-center space-x-4">
            <a href="/" class="flex items-center text-white">
                <img src="/images/wizard-logo.png" alt="wizard" class="h-10 p-2">
                <span class="font-bold text-xl"><?= config("app.name") ?></span>
            </a>
            <a href="/" class="<?= isUri("") ? 'underline ' : '' ?>text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Home</a>
            <a href="/contact" class="<?= isUri("contact") ? 'underline ' : '' ?>text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Contact</a>
            <a href="/about" class="<?= isUri("about") ? 'underline ' : '' ?>text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">About</a>
            <a href="/items/items-index" class="<?= isUri("items/items-index") ? 'underline ' : '' ?>text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Producten</a>
            <?php if (auth()): ?> 
            <a href="/bestel-status" class="<?= isUri("bestel-status") ? 'underline ' : '' ?>text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Bestelstatus</a>
            <?php endif; ?>
            <a href="/create-product" class="<?= isUri("create-product") ? 'underline ' : '' ?>text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Test</a>
        </div>
        <div class="flex items-center space-x-4">
            <?php if (auth()): ?>
                <a href="/cart" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                    <img src="/images/add-to-basket.png" alt="cart" class="h-6 w-6">
                </a>
                <div class="relative" x-data="{ open: false }" @click.away="open = false">
                    <div @click="open = !open" class="flex items-center cursor-pointer text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                        <span><?= user()->name ?></span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                    <div x-show="open" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 ring-1 ring-black ring-opacity-5 z-50" x-cloak>
                        <a href="/profiel-edit" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Profiel aanpassen
                        </a>
                        <a href="/wachtwoord-aanpassen" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                            </svg>
                            Wachtwoord aanpassen
                        </a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            Berichten
                        </a>
                        <?php if (hasRole('admin')): ?>
                            <a href="/admin-dashboard" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18M3 9h18M3 15h18M3 21h18"/>
                                </svg>
                                Dashboard
                            </a>
                        <?php endif; ?>
                        <a href="/logout" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            Sign out
                        </a>
                    </div>
                </div>
            <?php else: ?>
                <a href="/registreer-create" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Registreren</a>
                <a href="/login" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Login</a>
            <?php endif; ?>
        </div>
    </div>
</nav>