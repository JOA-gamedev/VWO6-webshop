<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Validatie
    if (empty($name) || empty($subject) || empty($message)) {
        $_SESSION['flash_message'] = "Alle velden zijn verplicht.";
        header("Location: /contact");
        exit;
    }

    // Check if user is logged in
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
        $klant_id = $user['id'];
    } else {
        $klant_id = 1; // Default klant_id for non-logged-in users
    }

    // Database connection
    $db = new Database();

    // Insert query
    $query = "INSERT INTO `jel_bestelt`.`berichten` (`klant_id`, `onderwerp`, `bericht`) VALUES (?, ?, ?)";
    $params = [$klant_id, $subject, $message];

    if ($db->query($query, $params)) {
        $_SESSION['flash_message'] = "Bericht succesvol opgeslagen!";
    } else {
        $_SESSION['flash_message'] = "Er is een fout opgetreden bij het opslaan van het bericht.";
    }

    header("Location: /contact");
    exit;
}

view("contact");
?>
