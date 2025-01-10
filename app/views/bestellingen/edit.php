<!-- views/bestellingen/edit.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Bestelling Bewerken</title>
</head>
<body>
    <h1>Bestelling Bewerken</h1>
    <form action="update.php?id=<?php echo $bestelling->id; ?>" method="post">
        <label for="klant">Klant:</label>
        <input type="text" id="klant" name="klant" value="<?php echo $bestelling->klant; ?>">
        <label for="status">Status:</label>
        <input type="text" id="status" name="status" value="<?php echo $bestelling->status; ?>">
        <button type="submit">Opslaan</button>
    </form>
    <a href="index.php">Terug naar overzicht</a>
</body>
</html>