<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Error</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
</head>
<body>
<div class="mx-auto max-w-7xl py-20 sm:px-6 lg:px:8">
    <h1 class="text-2xl font-bold  mb-4">401 Geen toegang: <?= $error ?? '' ?></h1>
    <p class="mt-2">
        <a href="/" class="text-indigo-800 hover:text-indigo-600">Ga terug naar home</a>
    </p>
</div>
</body>
</html>