<?php	
// Bestelling.php
class Bestelling {
    public static function all() {
        // Haal alle bestellingen op uit de database
        // Dit is een voorbeeld, je moet je eigen database logica toevoegen
        return [
            (object) ['id' => 1, 'klant' => 'Jan', 'status' => 'Verzonden'],
            (object) ['id' => 2, 'klant' => 'Piet', 'status' => 'In behandeling'],
        ];
    }

    public static function find($id) {
        // Zoek een specifieke bestelling op ID
        // Dit is een voorbeeld, je moet je eigen database logica toevoegen
        $bestellingen = self::all();
        foreach ($bestellingen as $bestelling) {
            if ($bestelling->id == $id) {
                return $bestelling;
            }
        }
        return null;
    }

    public function save() {
        // Sla de bestelling op in de database
        // Dit is een voorbeeld, je moet je eigen database logica toevoegen
    }

    public function delete() {
        // Verwijder de bestelling uit de database
        // Dit is een voorbeeld, je moet je eigen database logica toevoegen
    }
}