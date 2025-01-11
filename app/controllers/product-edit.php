<?php 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission (e.g., update the database)

    $id = $_POST['id'] ?? null;
    $naam = $_POST['naam'] ?? null;
    $prijs = $_POST['prijs'] ?? null;
    $beschrijving = $_POST['beschrijving'] ?? null;

    if (!$id || !$naam || !$prijs || !$beschrijving) {
        die("Alle velden zijn verplicht.");
    }

    $db = new Database();
    $db->query('UPDATE producten SET naam = ?, prijs = ?, beschrijving = ? WHERE id = ?', [
        $naam, $prijs, $beschrijving, $id
    ]);

    flash("Wijzigingen Opgeslagen: " . htmlspecialchars($naam), true);
    header("Location: /");
    exit;

} else {
    // Handle GET request (e.g., fetch the product details)
    $id = $_GET['id'] ?? null;

    if (!$id) {
        die("Geen product-ID opgegeven.");
    }

    $db = new Database();
    $product = $db->query('SELECT * FROM producten WHERE id = ?', [$id])->fetch();

    if (!$product) {
        die("Product niet gevonden.");
    }

    view("product-edit", [
        'product' => $product,
    ]);
}
