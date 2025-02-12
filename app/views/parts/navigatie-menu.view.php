<?php
if (!function_exists('isAdmin')) {
    function isAdmin() {
        // Implement your logic to check if the user is an admin
        return isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin';
    }
}
?>
<nav class="bg-gray-500">
    <div class="flex justify-between items-center">
        <div class="flex justify-start items-center text-xl space-x-4">
            <a href="/" class="flex items-center">
                <img src="/images/wizard-logo.png" alt="wizard" class="h-10 p-2">
                <span class="font-bold"><?= config("app.name") ?></span>
            </a>
            <a href="/" class="<?= isUri("") ? 'underline ' : '' ?>text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md font-medium">Home</a>
            <a href="/contact" class="<?= isUri("contact") ? 'underline ' : '' ?>text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md font-medium">Contact</a>
            <a href="/about" class="<?= isUri("about") ? 'underline ' : '' ?>text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md font-medium">Over ons</a>
            <a href="/items/items-index"
                class="<?= isUri("items/items-index") ? 'underline ' : '' ?>text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md font-medium">Producten</a>
            <?php if (auth()): ?> 
            <a href="/bestel-status"
                class="<?= isUri("bestel-status") ? 'underline ' : '' ?>text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md font-medium">Bestelstatus</a>
            <?php endif; ?>
        </div>
        <div class="flex items-center space-x-2"> <!-- Reduced space-x-4 to space-x-2 -->
            <a href="/cart" class="relative text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md font-medium">
                <img src="/images/cart1.png" alt="cart" class="h-6 w-6">
                <span class="absolute top-0 right-0 inline-block w-4 h-4 bg-red-500 text-white text-center rounded-full text-xs leading-4"><?= array_sum($_SESSION['winkelwagen'] ?? []) ?></span>
            </a>
            <?php if (auth()): ?>
                <div class="mr-2 py-1" x-data="{open: false}" @click="open = true" @mouseleave="open = false">
                    <div class="relative flex items-center space-x-1 cursor-pointer text-gray-700 hover:bg-pink-500 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">
                        <!-- Items waarop je kan klikken om uit te klappen -->
                        <div class="flex items-center">
                            <span><?= user()->name ?></span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="pl-1 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                        <!-- Uitklap blok dat verschijnt bij klikken -->
                        <div class="origin-top-right absolute top-10 right-0 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50" x-show="open" x-cloak role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                            <!-- Active: "bg-gray-100", Not Active: "" -->
                            <a href="/profiel-edit" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100  w-full inline-flex items-center" role="menuitem" tabindex="-1" id="user-menu-item-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Profiel aanpassen</a>
                            <a href="/wachtwoord-aanpassen" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100  w-full inline-flex items-center" role="menuitem" tabindex="-1" id="user-menu-item-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                                </svg>
                                Wachtwoord aanpassen</a>
                            <a href="/berichten-klant" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full inline-flex items-center" role="menuitem" tabindex="-1" id="user-menu-item-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                Berichten</a>
                            <?php if (isAdmin()): ?>
                                <a href="/admin/berichten" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full inline-flex items-center" role="menuitem" tabindex="-1" id="user-menu-item-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m-4 4h10M5 6h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2z"/>
                                    </svg>
                                    Admin Berichten
                                </a>
                                <a href="/admin-dashboard" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full inline-flex items-center" role="menuitem" tabindex="-1" id="user-menu-item-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18M3 9h18M3 15h18M3 21h18"/>
                                    </svg>
                                    Dashboard
                                </a>
                            <?php endif; ?>
                            <a href="/logout" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full inline-flex items-center" role="menuitem" tabindex="-1" id="user-menu-item-5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                Uitloggen</a>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <a href="/login" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md font-medium">
                    <img src="/images/user.png" alt="user" class="h-6 w-6">
                </a>
            <?php endif; ?>
        </div>
    </div>
</nav>