<?php

class User extends BaseModel {

    public $customer_id, $username, $password, $age,
            $country, $gender, $last_seen, $lookingf_type,
            $lookingf_age, $lookingf_gender;

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

            return $user -> customer_id;
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

            return $user -> username;
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

    public function validate_username() {
        return $this->validate_string_minmax($this->title, 1, 15);
    }

    public function validate_password() {
        return $this->validate_string_minmax($this->title, 1, 15);
    }

}
