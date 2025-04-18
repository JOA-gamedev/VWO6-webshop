<?php
view("parts/header", ['title' => 'Admin dashboard']);
view("parts/navigatie-menu");
?>
<div class="sm:mx-10">
    <h1 class="text-3xl my-4">Dashboard</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <a href="productbeheer" class="group block p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md hover:bg-[#52EBEB] hover:text-white transition duration-300">
            <div class="flex items-center justify-center mb-4 w-12 h-12 bg-[#52EBEB] rounded-full group-hover:bg-white">
                <i class="fas fa-box-open text-[#FFFFFF] group-hover:text-[#52EBEB]">
                    <span class="material-icons-outlined align-middle">inventory</span>
                </i>
            </div>
            <h5 class="mb-2 text-2xl font-bold tracking-tight">Productbeheer</h5>
        </a>
        <a href="bestellingen" class="group block p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md hover:bg-[#52EBEB] hover:text-white transition duration-300">
            <div class="flex items-center justify-center mb-4 w-12 h-12 bg-[#52EBEB] rounded-full group-hover:bg-white">
                <i class="fas fa-receipt text-[#FFFFFF] group-hover:text-[#52EBEB]">
                    <span class="material-icons-outlined align-middle">receipt_long</span>
                </i>
            </div>
            <h5 class="mb-2 text-2xl font-bold tracking-tight">Bestellingen beheren</h5>
        </a>
        <a href="user-management" class="group block p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md hover:bg-[#52EBEB] hover:text-white transition duration-300">
            <div class="flex items-center justify-center mb-4 w-12 h-12 bg-[#52EBEB] rounded-full group-hover:bg-white">
                <i class="fas fa-user-cog text-[#FFFFFF] group-hover:text-[#52EBEB]">
                    <span class="material-icons-outlined align-middle">manage_accounts</span>
                </i>
            </div>
            <h5 class="mb-2 text-2xl font-bold tracking-tight">Beheer gebruikersgegevens</h5>
        </a>
        <a href="/kortingscodes" class="group block p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md hover:bg-[#52EBEB] hover:text-white transition duration-300">
            <div class="flex items-center justify-center mb-4 w-12 h-12 bg-[#52EBEB] rounded-full group-hover:bg-white">
                <i class="fas fa-percentage text-[#FFFFFF] group-hover:text-[#52EBEB]">
                    <span class="material-icons-outlined align-middle">discount</span>
                </i>
            </div>
            <h5 class="mb-2 text-2xl font-bold tracking-tight">Kortingscodes beheren</h5>
        </a>
    </div>
</div>
<?php
view("parts/footer");
?>
