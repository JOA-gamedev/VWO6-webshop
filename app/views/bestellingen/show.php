<!-- views/bestellingen/show.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Bestelling Details</title>
</head>
<body>
    <h1>Bestelling Details</h1>
    <p>ID: <?php echo $bestelling->id; ?></p>
    <p>Klant: <?php echo $bestelling->klant; ?></p>
    <p>Status: <?php echo $bestelling->status; ?></p>
    <a href="index.php">Terug naar overzicht</a>
</body>
</html>