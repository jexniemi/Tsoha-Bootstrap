<?php

class User extends BaseModel {

    public $customer_id, $username, $password, $age,
            $country, $gender, $last_seen, $lf_type,
            $lf_agemin, $lf_agemax, $lf_gender;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array();
    }

    public static function find($customer_id) {
        $query = DB::connection()->prepare('SELECT * FROM Customer WHERE customer_id = :customer_id LIMIT 1');
        $query->execute(array('customer_id' => $customer_id));
        $row = $query->fetch();

        if ($row) {
            $user = new User(array(
                'customer_id' => $row['customer_id'],
                'username' => $row['username'],
                'password' => $row['password'],
                'age' => $row['age'],
                'country' => $row['country'],
                'gender' => $row['gender'],
                'last_seen' => $row['last_seen'],
                'lf_type' => $row['lf_type'],
                'lf_agemin' => $row['lf_agemin'],
                'lf_agemax' => $row['lf_agemax'],
                'lf_gender' => $row['lf_gender']
            ));

            return $user;
        }

        return null;
    }

    public static function findIdByUsername($username) {
        $query = DB::connection()->prepare('SELECT * FROM Customer WHERE username = :username LIMIT 1');
        $query->execute(array('username' => $username));
        $row = $query->fetch();

        if ($row) {
            $user = new User(array(
                'customer_id' => $row['customer_id']
            ));

            return $user->customer_id;
        }

        return null;
    }

    public static function findUsernameById($customer_id) {
        $query = DB::connection()->prepare('SELECT * FROM Customer WHERE customer_id = :customer_id LIMIT 1');
        $query->execute(array('customer_id' => $customer_id));
        $row = $query->fetch();

        if ($row) {
            $user = new User(array(
                'username' => $row['username']
            ));

            return $user->username;
        }

        return null;
    }

    public static function authenticate($username, $password) {
        $query = DB::connection()->prepare('SELECT * FROM Customer WHERE username = :username AND password = :password LIMIT 1');
        $query->execute(array('username' => $username, 'password' => $password));
        $row = $query->fetch();
        if ($row) {
            $user = new User(array(
                'customer_id' => $row['customer_id'],
                'username' => $row['username'],
                'password' => $row['password'],
            ));

            return $user;
        } else {
            return null;
        }
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE Customer '
                . 'SET country = :country, lf_type = :lf_type, lf_agemin = :lf_agemin, '
                . 'lf_agemax = :lf_agemax, lf_gender = :lf_gender'
                . 'WHERE customer_id = :customer_id '
                . 'RETURNING customer_id');

        $query->execute(array(
            'country' => $this->country,
            'lf_type' => $this->lf_type,
            'lf_agemin' => $this->lf_agemin,
            'lf_agemax' => $this->lf_agemax,
            'lf_gender' => $this->lf_gender));        
        
        $row = $query->fetch();

        Kint::trace();
        Kint::dump($row);

        $this->customer_id = $row['customer_id'];
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Customer (username, password, age, country, gender, lf_type, lf_agemin, lf_agemax, lf_gender) VALUES (:username, :password, :age, :country, :gender, :lf_type, :lf_agemin, :lf_agemax, :lf_gender) RETURNING customer_id');

        $query->execute(array(
            'username' => $this->username,
            'password' => $this->password,
            'age' => $this->age,
            'country' => $this->country,
            'gender' => $this->gender,
            'lf_type' => $this->lf_type,
            'lf_agemin' => $this->lf_agemin,
            'lf_agemax' => $this->lf_agemax,
            'lf_gender' => $this->lf_gender));

        $row = $query->fetch();

        Kint::trace();
        Kint::dump($row);

        $this->customer_id = $row['customer_id'];
    }

    public function delete() {
        $query = DB::connection()->prepare('DELETE FROM Customer WHERE customer_id = :customer_id');
        $query->execute(array('customer_id' => $this->customer_id));
    }

    public function validate_username() {
        return $this->validate_string_minmax($this->title, 4, 15);
    }

    public function validate_password() {
        return $this->validate_string_minmax($this->title, 4, 15);
    }

    public function validate_country() {
        return $this->validate_string_minmax($this->title, 2, 30);
    }

}
