<?php
view("parts/header", ['title' => 'contact']);
view("parts/navigatie-menu"); // Include the same navigation menu
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bestelstatus</title>
    <style>
        .status-container {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            font-family: 'Arial', sans-serif;
        }
        .status-container h1 {
            margin: 0 0 10px;
            font-size: 24px;
            color: #333;
        }
        .status-container p {
            font-size: 18px;
            color: #666;
        }
    </style>
</head>
<body>
    <!-- Remove the old navigation include -->
    <!-- <div class="navigation">
        <?php include 'path/to/navigation.php'; ?>
    </div> -->
    <div class="status-container">
        <h1>Uw Bestelstatus</h1>
        <p><?php echo htmlspecialchars($orderStatus); ?></p>
    </div>
</body>
</html>