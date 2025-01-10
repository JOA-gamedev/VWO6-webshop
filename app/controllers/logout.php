<?php

// hier gaan we uitloggen

// we gaan de sessie variabele 'user' verwijderen
unset($_SESSION['user']);

// we geven een melding dat je bent uitgelogd
flash("Je bent uitgelogd", true);

// we gaan terug naar de home pagina (maar je kan ook naar een andere pagina gaan)
header("Location: /");

