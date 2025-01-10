<?php
// BestellingenController.php
class BestellingenController {
    public function index() {
        $bestellingen = Bestelling::all();
        require 'views/bestellingen/index.php';
    }

    public function show($id) {
        $bestelling = Bestelling::find($id);
        require 'views/bestellingen/show.php';
    }

    public function edit($id) {
        $bestelling = Bestelling::find($id);
        require 'views/bestellingen/edit.php';
    }

    public function update($id) {
        $bestelling = Bestelling::find($id);
        // Verwerk de update logica hier
        $bestelling->save();
        header('Location: index.php');
    }

    public function delete($id) {
        $bestelling = Bestelling::find($id);
        $bestelling->delete();
        header('Location: index.php');
    }
}
