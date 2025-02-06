<?php
view("contact");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Validatie
    if (empty($name) || empty($subject) || empty($message)) {
        echo "Alle velden zijn verplicht.";
        exit;
    }

    // Database connection
    $db = new mysqli("localhost", "root", "", "jel_bestelt");

    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    // Insert query
    $stmt = $db->prepare("INSERT INTO berichten (klant_id, onderwerp, bericht) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $klant_id, $subject, $message);

    // Assuming klant_id is fetched or set somewhere in your code
    $klant_id = 1; // Example klant_id

    if ($stmt->execute()) {
        echo "Bericht succesvol opgeslagen!";
    } else {
        echo "Er is een fout opgetreden bij het opslaan van het bericht.";
    }

    $stmt->close();
    $db->close();
}
?>
