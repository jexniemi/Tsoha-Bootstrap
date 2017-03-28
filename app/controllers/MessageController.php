<?php

class MessageController extends BaseController{
    public static function index(){
        $games = Game::all();
        View::make('suunnitelmat/messages.html', array('messages' => $games));
}
}
