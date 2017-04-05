<?php

class UserCtrl extends BaseController{
  public static function login(){
      View::make('profile/login.html');
  }
  
  public static function handle_login(){
    $params = $_POST;

    $user = User::authenticate($params['username'], $params['password']);

    if(!$user){
      View::make('profile/login.html', array('msg' => 'Invalid username or password', 'username' => $params['username']));
    }else{
      $_SESSION['user'] = $user->customer_id;

      Redirect::to('/', array('msg' => 'Welcome ' . $user->username . '!'));
    }
  }
}