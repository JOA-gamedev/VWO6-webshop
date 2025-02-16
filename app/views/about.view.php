<?php
view("parts/header", ['title' => 'Over ons']);
view("parts/navigatie-menu");

?>
    <div class="sm:mx-10">
        <h1 class="text-3xl my-4">Over ons</h1>

        <p class="my-4">Welkom bij <span class="font-bold text-black"><?= config("app.name") ?></span> – dé plek waar stijl en technologie samenkomen! 
            Wij zijn een team van drie enthousiaste 6 vwo-studenten met een passie voor mode én programmeren. 
            Wat begon als een schoolproject groeide uit tot deze unieke kledingwebsite, helemaal zelf gecodeerd en ontworpen door ons. 
            Van trendy outfits tot tijdloze basics – wij zorgen ervoor dat je altijd iets vindt dat bij je past. 
            En het mooiste? Achter de schermen draait alles op onze eigen code! We hebben hard gewerkt om een soepele en toffe shopervaring neer te zetten, en we blijven ons platform verbeteren. 
            Dus neem een kijkje, shop je favoriete items, en support een project dat is gebouwd met creativiteit, teamwork en een flinke dosis doorzettingsvermogen! 
            Heb je vragen of feedback? Laat het ons weten, we horen graag van je! Je kunt ons bereiken via <span class="font-bold text-black"><?= config("app.email") ?></span>.
        </p>

<?php
view("parts/footer");
?>
