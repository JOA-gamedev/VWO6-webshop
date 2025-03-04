<?php
// if ($_SERVER['REQUEST_URI'] == '/' && !isset($_SESSION['hide_ticker'])): // temp remove fix 
?>
<div x-data="{ showTicker: true }" x-show="showTicker"
    class="bg-primary text-black h-16 py-8 flex justify-center items-center border-b-[1px] border-black">
    <div class="marquee-container">
        <div class="marquee-content">
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
    .marquee-container {
        overflow: hidden;
        white-space: nowrap;
        box-sizing: border-box;
        width: 100%;
    }

    .marquee-content {
        display: flex;
        gap: 10px;
        /* Adjust the gap as needed */
        text-transform: uppercase;
        animation: marquee 10s linear infinite;
        font-family: "inter", sans-serif;
        font-weight: 400;

    }

    @keyframes marquee {
        0% {
            transform: translateX(100%);
        }

        100% {
            transform: translateX(-100px);
        }
    }
</style>
<? //php endif; temp removes 
?>