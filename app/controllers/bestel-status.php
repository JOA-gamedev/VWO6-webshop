<?php

// Verbind met de database
$db = new Database();

// Haal het ingelogde gebruikers-ID op
$userId = $_SESSION['user']['id'] ?? null;

// Haal de bestellingen op als de gebruiker is ingelogd
$orders = [];
if ($userId) {
    $orders = $db->query(
        '
        SELECT br.*, p.naam, p.beschrijving, p.kleur, p.geslacht, b.status, b.straat, b.huisnr, b.postcode, b.plaats, b.created_at, k.percentage,
        (br.prijs * br.aantal) as totaal, 
        (SELECT SUM(br2.prijs * br2.aantal) FROM bestelregels br2 WHERE br2.bestelling_id = br.bestelling_id) as totaalbedrag
        FROM bestelregels br
        JOIN producten p ON br.product_id = p.id
        JOIN bestellingen b ON br.bestelling_id = b.id
        LEFT JOIN kortingcodes k ON b.kortingcode_id = k.id
        WHERE b.klant_id = ?
        LIMIT 1000',
        [$userId]
    )->fetchAll();
}

// Groepeer de bestellingen per bestelling ID
$groupedOrders = [];
foreach ($orders as $order) {
    $bestellingId = $order['bestelling_id'];
    if (!isset($groupedOrders[$bestellingId])) {
        $groupedOrders[$bestellingId] = [
            'status' => $order['status'],
            'straat' => $order['straat'],
            'huisnr' => $order['huisnr'],
            'postcode' => $order['postcode'],
            'plaats' => $order['plaats'],
            'created_at' => $order['created_at'],
            'percentage' => $order['percentage'],
            'totaalbedrag' => $order['totaalbedrag'],
            'producten' => []
        ];
    }
    $groupedOrders[$bestellingId]['producten'][] = [
        'id' => $order['product_id'],
        'naam' => $order['naam'],
        'beschrijving' => $order['beschrijving'],
        'kleur' => $order['kleur'],
        'geslacht' => $order['geslacht'],
        'prijs' => $order['prijs'],
        'aantal' => $order['aantal'],
        'totaal' => $order['totaal']
    ];
}

// Toon de bestellingen in de view
view("bestel-status", [
    'orders' => $groupedOrders
]);