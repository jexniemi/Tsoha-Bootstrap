<?php

class HelloWorldController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        echo 'Tamä on etusivu!';
    }

    public static function sandbox() {
        // Testaa koodiasi täällä
        $message = new Message(array(
        'receiver' => 'asdasdas',
        'title' => 'as',
        'content' => 'asdassda',
        'time' => 'asdasd',
        'sender' => 'asdadasa'

        ));
        $errors = $message -> errors();
        
        Kint::dump($errors);
    }

    public static function front() {
        View::make('frontpage.html');
    }

    public static function browseProfiles() {
        self::check_logged_in();
        View::make('profile/browseFriends.html');
    }

    public static function login() {
        View::make('profile/login.html');
    }

    public static function myPage() {
        View::make('page/viewpage.html');
    }

    public static function myPageEdit() {
        View::make('page/editpage.html');
    }

    public static function profile() {
        View::make('profile/myprofile.html');
    }

    public static function editProfile() {
        View::make('profile/editprofile.html');
    }

    public static function messages() {
        View::make('message/messages.html');
    }

    public static function newMessage() {
        View::make('message/newMessage.html');
    }

    public static function viewMessage() {
        View::make('message/viewMessage.html');
    }

    public static function register() {
        View::make('profile/register.html');
    }

}
