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
                <img src="/images/logo1.png" alt="Logo" class="h-10 p-2">
            </a>
            <a href="/" class="<?= isUri("") ? 'underline ' : '' ?>text-black hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md font-medium">Home</a>
            <a href="/contact" class="<?= isUri("contact") ? 'underline ' : '' ?>text-black hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md font-medium">Contact</a>
            <a href="/about" class="<?= isUri("about") ? 'underline ' : '' ?>text-black hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md font-medium">Over ons</a>
            <a href="/items/items-index"
                class="<?= isUri("items/items-index") ? 'underline ' : '' ?>text-black hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md font-medium">Producten</a>
            <?php if (auth()): ?> 
            <a href="/bestel-status"
                class="<?= isUri("bestel-status") ? 'underline ' : '' ?>text-black hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md font-medium">Bestelstatus</a>
            <?php endif; ?>
        </div>
        <div class="flex items-center space-x-2"> <!-- Reduced space-x-4 to space-x-2 -->
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="ml-2">
                    <span class="material-icons-outlined align-middle">search</span>
                </button>
                <form method="GET" action="/search" class="absolute top-10 left-[-10rem] bg-white p-2 rounded shadow-md flex items-center" x-show="open" @click.away="open = false">
                    <input type="text" name="query" placeholder="Zoeken..." class="border p-1 rounded w-48">
                    <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded ml-2">Zoeken</button>
                </form>
            </div>
            <a href="/cart" class="relative text-black hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md font-medium">
                <span class="material-icons-outlined align-middle">shopping_bag</span>
                <span class="absolute top-0 right-0 inline-block w-4 h-4 bg-red-500 text-white text-center rounded-full text-xs leading-4"><?= array_sum($_SESSION['winkelwagen'] ?? []) ?></span>
            </a>
            <?php if (auth()): ?>
                <div class="mr-2 py-1" x-data="{open: false}" @click="open = true" @mouseleave="open = false">
                    <div class="relative flex items-center space-x-1 cursor-pointer text-black hover:bg-pink-500 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">
                        <!-- Items waarop je kan klikken om uit te klappen -->
                        <div class="flex items-center">
                            <span><?= user()->name ?></span>
                            <span class="material-icons-outlined">expand_more</span>
                        </div>
                        <!-- Uitklap blok dat verschijnt bij klikken -->
                        <div class="origin-top-right absolute top-10 right-0 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50" x-show="open" x-cloak role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                            <!-- Active: "bg-gray-100", Not Active: "" -->
                            <a href="/profiel-edit" class="p-2 gap-2 text-sm text-black hover:bg-gray-100  w-full inline-flex items-center" role="menuitem" tabindex="-1" id="user-menu-item-0">
                                <span class="material-icons-outlined align-middle">account_circle</span>
                                Profiel aanpassen</a>
                            <a href="/wachtwoord-aanpassen" class="p-2 gap-2 text-sm text-black hover:bg-gray-100  w-full inline-flex items-center" role="menuitem" tabindex="-1" id="user-menu-item-1">
                                <span class="material-icons-outlined align-middle">password</span>
                                Wachtwoord aanpassen</a>
                            <a href="/berichten-klant" class="p-2 gap-2 text-sm text-black hover:bg-gray-100 w-full inline-flex items-center" role="menuitem" tabindex="-1" id="user-menu-item-2">
                                <span class="material-icons-outlined align-middle">chat</span>
                                Berichten</a>
                            <?php if (isAdmin()): ?>
                                <a href="/admin/berichten" class="p-2 gap-2 text-sm text-black hover:bg-gray-100 w-full inline-flex items-center" role="menuitem" tabindex="-1" id="user-menu-item-3">
                                    <span class="material-icons-outlined align-middle">inbox</span>
                                    Admin inbox
                                </a>
                                <a href="/admin-dashboard" class="p-2 gap-2 text-sm text-black hover:bg-gray-100 w-full inline-flex items-center" role="menuitem" tabindex="-1" id="user-menu-item-4">
                                    <span class="material-icons-outlined align-middle">dashboard</span>
                                    Dashboard
                                </a>
                            <?php endif; ?>
                            <a href="/logout" class="p-2 gap-2 text-sm text-black hover:bg-gray-100 w-full inline-flex items-center" role="menuitem" tabindex="-1" id="user-menu-item-5">
                                <span class="material-icons-outlined align-middle">logout</span>
                                Uitloggen</a>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <a href="/login" class="text-black hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md font-medium">
                    <span class="material-icons-outlined align-middle">account_circle</span>
                </a>
            <?php endif; ?>
        </div>
    </div>
</nav>