<div x-data="{ showTicker: true }" x-show="showTicker" class="bg-blue-600 text-white py-2 relative">
    <div class="container mx-auto">
        <marquee behavior="scroll" direction="left">
            Welkom bij onze Kledingwinkel! Bekijk onze nieuwste collectie en aanbiedingen!
        </marquee>
        <button @click="showTicker = false" class="absolute top-0 right-0 mt-2 mr-2 text-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
</div>
