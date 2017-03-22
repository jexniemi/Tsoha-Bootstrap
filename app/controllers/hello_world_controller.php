<?php

class HelloWorldController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        echo 'Tamä on etusivu!';
    }

    public static function sandbox() {
        // Testaa koodiasi täällä
        View::make('helloworld.html');
    }

    public static function front() {
        View::make('suunnitelmat/frontpage.html');
    }

    public static function browseProfiles() {
        View::make('suunnitelmat/browseFriends.html');
    }

    public static function login() {
        View::make('suunnitelmat/login.html');
    }

    public static function profile() {
        View::make('suunnitelmat/myProfile.html');
    }

    public static function editProfile() {
        View::make('suunnitelmat/myProfileEdit.html');
    }

    public static function messages() {
        View::make('suunnitelmat/messages.html');
    }

}
