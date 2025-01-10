<?php
view("contact");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    $to = "jens.mesman@gmail.com"; // Vervang dit met het e-mailadres waar je de test e-mail naartoe wilt sturen
    $headers = "From: " . $email;

    $mailSent = mail($to, $subject, $message, $headers);

    if ($mailSent) {
        echo "E-mail succesvol verzonden!";
    } else {
        echo "Er is een fout opgetreden bij het verzenden van de e-mail.";
    }
}
?>
