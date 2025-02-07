<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSS only Material input</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <div class="page-wrapper">
        <div class="outlined-input">
            <input type="text" name="test" placeholder=" ">
            <label for="test">Naam</label>
        </div>
        <div class="standard-input">
            <input type="text" name="test" placeholder=" ">
            <label for="test">Achternaam</label>
            <span class="underline"></span>
        </div>
    </div>
</body>

</html>