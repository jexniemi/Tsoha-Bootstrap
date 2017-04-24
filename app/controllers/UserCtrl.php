<?php

class UserCtrl extends BaseController {

    public static function login() {
        View::make('profile/login.html');
    }

    public static function handle_login() {
        $params = $_POST;

        $user = User::authenticate($params['username'], $params['password']);

        if (!$user) {
            View::make('profile/login.html', array('msg' => 'Invalid username or password', 'username' => $params['username']));
        } else {
            $_SESSION['user'] = $user->customer_id;

            Redirect::to('/', array('msg' => 'Welcome ' . $user->username . '!'));
        }
    }

    public static function editProfile() {
        $attributes = array(
            'customer_id' => self::get_user_logged_in()->customer_id
        );

        View::make('profile/editprofile.html', array('attributes' => $attributes));
    }

    public static function destroy($customer_id) {
        $user = new User(array('customer_id' => $customer_id));
        $user->delete();

        $_SESSION['user'] = null;
        Redirect::to('/', array('msg' => 'Account deleted succesfully'));
    }

    public static function logout() {
        $_SESSION['user'] = null;
        Redirect::to('/login', array('msg' => 'You have logged out!'));
    }

    public static function register() {

        for ($i = 18; $i < 100; $i++) {
            $ages[] = $i;
        }

        View::make('profile/register.html', array('ages' => $ages));
    }
    
        public static function update($page_id) {
        $params = $_POST;

        $attributes = array(
            'country' => $params['country'],
            'lf_agemin' => $params['lf_agemin'],
            'lf_agemax' => $params['lf_agemax'],
            'lf_gender' => $params['lf_gender']
        );

        $user = new User($attributes);
        $errors = $user->errors();

        if (count($errors) > 0) {
            View::make('editprofile', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $user->update();
            Redirect::to('/myprofile' . $user->customer_id, array('msg' => 'Profile edit succesful'));
        }
    }

    public static function store() {
        $params = $_POST;

        $attributes = array(
            'username' => $params['username'],
            'password' => $params['password'],
            'age' => $params['age'],
            'country' => $params['country'],
            'gender' => $params['gender'],
            'lf_type' => $params['lf_type'],
            'lf_agemin' => $params['lf_agemin'],
            'lf_agemax' => $params['lf_agemax'],
            'lf_gender' => $params['lf_gender']
        );

        $user = new User($attributes);
        $errors = $user->errors();

        if (count($errors) == 0) {
            $user->save();

            Redirect::to('/', array('msg' => 'Account created, you can log in now'));
        } else {
            View::make('/register', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

}
