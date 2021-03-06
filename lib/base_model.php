<?php

class BaseModel {

// "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null) {
// Käydään assosiaatiolistan avaimet läpi
        foreach ($attributes as $attribute => $value) {
// Jos avaimen niminen attribuutti on olemassa...
            if (property_exists($this, $attribute)) {
// ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
                $this->{$attribute} = $value;
            }
        }
    }

    public function errors() {
// Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
        $errors = array();

        foreach ($this->validators as $validator) {
            $errors = array_merge($errors, $this->{$validator}());
// Kutsu validointimetodia tässä ja lisää sen palauttamat virheet errors-taulukkoon
        }

        return $errors;
    }

    public function validate_string_minmax($fieldName, $string, $min, $max) {
        $errors = array();
        if ($string == '' || $string == null) {
            $errors[] = $fieldName .  ' must not be empty!';
        }
        if (strlen($string) < $min) {
            $errors[] = $fieldName .  ' must contain at least ' . $min . ' characters!';
        }
        if (strlen($string) > $max) {
            $errors[] = $fieldName .  ' must contain less than ' . $max . ' characters';
        }

        return $errors;
    }

    public function validate_num($int, $min, $max) {
        $errors = array();
        if ($int < $min || $int > $max) {
            $errors[] = 'Number needs to be between ' . $min . " and " . $max;
        }

        return $errors;
    }

    public function validate_username($username) {
        $errors = array();
        $query = DB::connection()->prepare('SELECT * FROM Customer WHERE username = :username LIMIT 1');
        $query->execute(array('username' => $username));
        $row = $query->fetch();

        if (!$row) {
            $errors[] = 'Given username does not exist';
        }

        return $errors;
    }

}
