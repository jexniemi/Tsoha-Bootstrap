<?php

class Game extends BaseModel {

// Attribuutit
    public $id, $player_id, $name, $played, $description, $published, $publisher, $added;

// Konstruktori
    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
// Alustetaan kysely tietokantayhteydellämme
        $query = DB::connection()->prepare('SELECT * FROM Game');
// Suoritetaan kysely
        $query->execute();
// Haetaan kyselyn tuottamat rivit
        $rows = $query->fetchAll();
        $games = array();

// Käydään kyselyn tuottamat rivit läpi
        foreach ($rows as $row) {
// Tämä on PHP:n hassu syntaksi alkion lisäämiseksi taulukkoon :)
            $games[] = new Game(array(
                'id' => $row['id'],
                'player_id' => $row['player_id'],
                'name' => $row['name'],
                'played' => $row['played'],
                'description' => $row['description'],
                'published' => $row['published'],
                'publisher' => $row['publisher'],
                'added' => $row['added']
            ));
        }

        return $games;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Game WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $game = new Game(array(
                'id' => $row['id'],
                'player_id' => $row['player_id'],
                'name' => $row['name'],
                'played' => $row['played'],
                'description' => $row['description'],
                'published' => $row['published'],
                'publisher' => $row['publisher'],
                'added' => $row['added']
            ));

            return $game;
        }

        return null;
    }

}
