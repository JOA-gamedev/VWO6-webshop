<?php
//Let op in onderstaande code wordt ervan uitgegaan dat in de index.php de volgende code staat:
session_start();
$config = require __DIR__ . "/../app/config.php";

//handige functies
require __DIR__ . "/../src/functions.php";

//Database class
require __DIR__ . "/../src/Database.php";

//csrf protection
require __DIR__ . "/../src/csrf.php";

//routes
require __DIR__ . "/../app/router.php";

////////////////////////////////////////
/// PHP code //////////////////////////
///////////////////////////////////////

//variabele aanmaken
$naam = "Maurice";

//variabele tonen
echo $naam;

//variabele tonen met html
echo "<h1>" . $naam . "</h1>";

//variabele tonen met html (kortere versie)
echo "<h1>$naam</h1>";

//variabele tonen met html (kortere versie)
echo "<h1>{$naam}</h1>";

//variabele tonen met html (kortere versie)
?>
    <div>
        <h1><?= $naam ?></h1>
    </div>
<?php

//array aanmaken
$namen = ["Maurice", "John", "Ben"];

//variabele uit array tonen (eerste element)
echo $namen[0];

//key value array aanmaken
$namen = [
    "voornaam" => "Maurice",
    "achternaam" => "Merlier",
    "leeftijd" => 45
];

//variabele uit array tonen (eerste element)
echo $namen["voornaam"];

//array met meerdere arrays
$personen = [
    [
        "voornaam" => "Maurice",
        "achternaam" => "Merlier",
        "leeftijd" => 45
    ],
    [
        "voornaam" => "Michael",
        "achternaam" => "Johnson",
        "leeftijd" => 22
    ],
];

//variabele uit array tonen (eerste element)
echo $personen[0]["voornaam"];

//loop door een array met foreach
foreach ($personen as $persoon) {
    echo $persoon["voornaam"] . "<br>";
}

//loop door een array binnen html
?>
    <ul>
        <?php foreach ($personen as $persoon): ?>
            <li><?= $persoon["voornaam"] ?></li>
        <?php endforeach; ?>
    </ul>
<?php

/////////////////////////////////////////////////
/// PHP functies ////////////////////////////////
/////////////////////////////////////////////////
// Hieronder een aantal veel gebruikte php functies

// lengte van een string: strlen($var)
$naam = "Maurice";
echo strlen($naam); //geeft 7

// string omzetten naar hoofdletters: strtoupper($var)
$naam = "Maurice";
echo strtoupper($naam); //geeft MAURICE

// string omzetten naar kleine letters: strtolower($var)
$naam = "Maurice";
echo strtolower($naam); //geeft maurice

// spaties voor en na de invoer weghalen: trim($var)
$naam = " Maurice ";
echo trim($naam); //geeft Maurice

// string vervangen: str_replace($search, $replace, $subject)
$naam = "Maurice";
echo str_replace("Maurice", "John", $naam); //geeft John

//////////////////////////////////////////////////
/// Zelf functies maken //////////////////////////
//////////////////////////////////////////////////

function getFullName($voornaam, $achternaam)
{
    return $voornaam . " " . $achternaam;
}

//functie aanroepen
echo getFullName("Maurice", "Merlier");

//functie aanroepen met variabelen
$voornaam = "Maurice";
$achternaam = "Merlier";
echo getFullName($voornaam, $achternaam);

//gebruik van if else
$leeftijd = 45;
if ($leeftijd > 18) {
    echo "Je bent ouder dan 18";
} else {
    echo "Je bent jonger dan 18";
}

//gebruik van if else in html
?>
    <div>
        <?php if ($leeftijd > 18): ?>
            <h1>Je bent ouder dan 18</h1>
        <?php else: ?>
            <h1>Je bent jonger dan 18</h1>
        <?php endif; ?>
    </div>
<?php
//gebruik van switch
$leeftijd = 45;
switch ($leeftijd) {
    case 18:
        echo "Je bent 18";
        break;
    case 19:
        echo "Je bent 19";
        break;
    default:
        echo "Je bent geen 18 of 19";
}

////////////////////////////////////////
/// Database gebruiken //////////// ////
////////////////////////////////////////

//database object initialiseren
$db = new Database();

//query uitvoeren (met 1 resultaat) en opslaan in een variabele $result (waarbij in de query een parameter wordt gebruikt)
$result = $db->query("SELECT * FROM posts WHERE id = ?", [
    1
])->fetch();

//query uitvoeren (met 1 resultaat) en opslaan in een variabele $result (waarbij in de query een 'named' parameter wordt gebruikt)
$result = $db->query("SELECT * FROM posts WHERE id = :id", [
    'id' => 1
])->fetch();

//query uitvoeren (met meerdere resultaten) en opslaan in een variabele $result (array)
$result = $db->query("SELECT * FROM posts")->fetchAll();

//query uitvoeren zonder resultaat (insert, update, delete)
$db->query("INSERT INTO posts (title, content) VALUES (?, ?)", [
    "Mijn titel",
    "Mijn content"
]);
//het id van de laatste insert opvragen
$id = $db->lastInsertId();

$db->query("UPDATE posts SET title = ?, content = ? WHERE id = ?", [
    "Mijn titel",
    "Mijn content",
    1
]);
$db->query("DELETE FROM posts WHERE id = ?", [
    1
]);

//query uitvoeren zonder resultaat (insert, update, delete) met 'named' parameters (let op de dubbele punt voor de parameter)
$db->query("INSERT INTO posts (title, content) VALUES (:title, :content)", [
    'title' => "Mijn titel",
    'content' => "Mijn content"
]);
$db->query("UPDATE posts SET title = :title, content = :content WHERE id = :id", [
    'title' => "Mijn titel",
    'content' => "Mijn content",
    'id' => 1
]);
$db->query("DELETE FROM posts WHERE id = :id", [
    'id' => 1
]);

//sql queries select, insert, update, delete voorbeelden
//select
$db->query("SELECT * FROM posts")->fetchAll();
$db->query("SELECT * FROM posts WHERE id = ?", [1])->fetch();
$db->query("SELECT * FROM posts WHERE id = :id", ['id' => 1])->fetch();
//insert
$db->query("INSERT INTO posts (title, content) VALUES (?, ?)", ["Mijn titel", "Mijn content"]);
$db->query("INSERT INTO posts (title, content) VALUES (:title, :content)", ['title' => "Mijn titel", 'content' => "Mijn content"]);
//update
$db->query("UPDATE posts SET title = ?, content = ? WHERE id = ?", ["Mijn titel", "Mijn content", 1]);
$db->query("UPDATE posts SET title = :title, content = :content WHERE id = :id", ['title' => "Mijn titel", 'content' => "Mijn content", 'id' => 1]);
//delete
$db->query("DELETE FROM posts WHERE id = ?", [1]);
$db->query("DELETE FROM posts WHERE id = :id", ['id' => 1]);

//flash message tonen
flash("Post is opgeslagen", true, 3000); //true = succes, 3000 = 3 seconden

?>
    <!--
        ////////////////////////////////////////
        /////////////// Formulieren ////////////
        ////////////////////////////////////////


        Formulier maken (voorbeeld
         action: de url waar het formulier naartoe moet
         method: de methode die gebruikt moet worden (get of post)
         csrf: de csrf token (voor veiligheid)
         name: de naam van het veld (wordt gebruikt om de waarde op te halen)
         value: de waarde van het veld
         placeholder: de tekst die in het veld wordt getoond
         required: het veld is verplicht
         type: het type veld (text, password, email, number, date, time, url, color, range, search, tel) -->
    <form action="/posts" method="post">
        <?= csrf() ?>
        <input type="text" name="title" placeholder="Titel" required>
        <textarea name="content" placeholder="Content"></textarea>
        <input type="submit" value="Opslaan">
    </form>

    <!-- input fields -->
    <!-- text -->
    <input type="text" name="title" placeholder="Titel">
    <!-- password -->
    <input type="password" name="password" placeholder="Wachtwoord">
    <!-- email -->
    <input type="email" name="email" placeholder="E-mailadres">
    <!-- number -->
    <input type="number" name="age" placeholder="Leeftijd">
    <!-- date -->
    <input type="date" name="date" placeholder="Datum">
    <!-- time -->
    <input type="time" name="time" placeholder="Tijd">
    <!-- url -->
    <input type="url" name="url" placeholder="URL">
    <!-- color -->
    <input type="color" name="color" placeholder="Kleur">
    <!-- range -->
    <input type="range" name="range" placeholder="Range">

    <!-- textarea -->
    <textarea name="content" placeholder="Content..."></textarea>

    <!-- selectbox -->
    <select name="contry">
        <option value=""></option>
        <option value="NL">Nederland</option>
        <option value="BE">België</option>
        <option value="DE">Duitsland</option>
        <option value="FR">Frankrijk</option>
        <option value="UK">Engeland</option>
    </select>

    <!-- met een voorgeselecteerde option -->
    <select name="contry">
        <option value=""></option>
        <option value="NL" selected>Nederland</option>
        <option value="BE">België</option>
        ...
    </select>

    <!-- checkbox -->
    <input type="checkbox" name="terms" value="1">

    <!-- radiobuttons -->
    <input type="radio" name="sex" value="M">Man<br>
    <input type="radio" name="sex" value="V">Vrouw<br>
    <input type="radio" name="sex" value="X">Anders<br>

    <!-- hidden field -->
    <input type="hidden" name="id" value="1">

    <!-- submit button -->
    <input type="submit" value="Opslaan" name="save" class="border border-1 rounded-md px-2 py-1 hover:bg-gray-100 cursor-pointer">

    <!-- of button -->
    <button type="submit" name="save" class="border border-1 rounded-md px-2 py-1 hover:bg-gray-100 cursor-pointer">
        Opslaan
    </button>

    <!-- validatie bij een form field -->
<?php if (isset($errors['veldnaam'])): ?>
    <p class="text-red-500 text-sm my-2"><?= $errors['veldnaam'] ?></p>
<?php endif; ?>
<?php
////////////////////////////////////////
/////////////// Sessions ///////////////
////////////////////////////////////////

//starten van een sessie
session_start();

//variabele in de sessie zetten
$_SESSION['naam'] = "Maurice";

//variabele uit de sessie halen
echo $_SESSION['naam'];

//sessie variabele verwijderen
unset($_SESSION['naam']);

//sessie verwijderen
session_destroy();

////////////////////////////////////////
/// Cookies ////////////////////////////
////////////////////////////////////////
///
//cookie zetten
setcookie("naam", "Maurice", time() + 3600);

//cookie uitlezen
echo $_COOKIE['naam'];

//cookie verwijderen
setcookie("naam", "", time() - 3600);

////////////////////////////////////////
/// Bestanden //////////////////////////
////////////////////////////////////////
///
//bestand inlezen
$bestand = file_get_contents("bestand.txt");

//bestand schrijven
file_put_contents("bestand.txt", "Hallo");

//bestand verwijderen
unlink("bestand.txt");

//bestand verplaatsen
rename("bestand.txt", "nieuwbestand.txt");

//bestand kopiëren
copy("bestand.txt", "nieuwbestand.txt");

//bestand uploaden
move_uploaded_file($_FILES['bestand']['tmp_name'], "bestand.txt");

////////////////////////////////////////
/// Classes ////////////////////////////
////////////////////////////////////////

//class aanmaken
class Persoon
{
    //variabelen
    public $voornaam;
    public $achternaam;
    public $leeftijd;

    //constructor
    public function __construct($voornaam, $achternaam, $leeftijd)
    {
        $this->voornaam = $voornaam;
        $this->achternaam = $achternaam;
        $this->leeftijd = $leeftijd;
    }

    //functie
    public function getFullName()
    {
        return $this->voornaam . " " . $this->achternaam;
    }
}

//class gebruiken
$persoon = new Persoon("Maurice", "Merlier", 45);

//functie aanroepen
echo $persoon->getFullName();

////////////////////////////////////////
/// Veiligheid /////////////////////////
////////////////////////////////////////

/// gebruik van htmlspecialchars
?>
    <h1><?= $naam ?></h1> (onveilig)
    <h1><?= htmlspecialchars($naam) ?></h1> (veilig)

<?php
///////////////////////////////////////////
/// Validators /////////////////////////////
/// ////////////////////////////////////////
///
Validator::required($var);         // $var is niet leeg
Validator::integer($var);          // $var is een geheel getal
Validator::length($var, $min, $max); // $var heeft een string lengte tussen $min en $max (inclusief)
Validator::email($var);            // $var is een geldig email adres
Validator::url($var);              // $var is een geldige url
Validator::date($var);             // $var is een geldige datum
Validator::min($var, $min);         // $var is hoger of gelijk aan $min
Validator::max($var, $max);         // $var is lager of gelijk aan $max
Validator::between($var, $min, $max); // $var zit tussen $min en $max (inclusief)
Validator::in($var, $array);       // $var komt voor in de array $array
Validator::notIn($var, $array);     // $var komt niet voor in de array $array
Validator::regex($var, $regex);     // $var voldoet aan de gegeven regex expressie

//voorbeeld van het gebruik van validators
require "../src/Validator.php";
$errors = [];
if (!Validator::required($_POST['naam'])) {
    $errors['naam'] = "Naam is verplicht";
}

/*  SQL query voorbeelden
-- Voorbeeld van een query met AND en OR
SELECT *
FROM leerlingen
WHERE plaats = 'utrecht'
AND (achternaam LIKE '%p%'
OR voornaam LIKE '%p%');

-- Voorbeeld van een query met meerdere tabellen
SELECT *
FROM auteurs, boeken
WHERE auteurs.auteurnr = boeken.auteurnr
AND boeken.titel = 'Au pair!';
*/