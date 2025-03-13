<?php
if ($_SERVER['REQUEST_URI'] == '/' && !isset($_SESSION['hide_ticker']) && !isset($_SESSION['admin'])): ?>
<div x-data="{ showTicker: true }" x-show="showTicker" class="bg-primary text-black h-16 py-8 flex justify-center items-center border-b border-black">
    <div class="overflow-hidden whitespace-nowrap box-border w-full">
        <div class="flex gap-2 uppercase animate-marquee font-inter font-normal">
            <span>WELKOM BIJ ONZE KLEDINGWINKEL!</span>
            <span>//</span>
            <span>BEKIJK ONZE NIEUWSTE COLLECTIE EN AANBIEDINGEN!</span>
            <span>//</span>
            <span>GEBRUIK TIJDELIJK DE CODE 'JOACHIM30' VOOR 30% KORTING OP UW BESTELLING!</span>
            <span>//</span>
            <span>WELKOM BIJ ONZE KLEDINGWINKEL!</span>
            <span>//</span>
            <span>BEKIJK ONZE NIEUWSTE COLLECTIE EN AANBIEDINGEN!</span>
            <span>//</span>
            <span>GEBRUIK TIJDELIJK DE CODE 'JOACHIM30' VOOR 30% KORTING OP UW BESTELLING!</span>
            <span>//</span>
        </div>
    </div>
    <button @click="showTicker = false; <?php $_SESSION['hide_ticker'] = true; ?>" class="px-4">
        <span class="material-icons-outlined">
            close
        </span>
    </button>
</div>
<style>
    @keyframes marquee {
        0% {
            transform: translateX(100%);
        }
        100% {
            transform: translateX(-100px);
        }
    }
    .animate-marquee {
        animation: marquee 10s linear infinite;
    }
</style>
<?php endif; ?>