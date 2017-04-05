<?php

class MessageController extends BaseController {

    public static function messages() {
        self::check_logged_in();
        $messages = Message::receiverAll(self::get_user_logged_in( ) -> customer_id);
        View::make('message/messages.html', array('messages' => $messages));
    }

    public static function viewMessage($message_id) {
        $message = Message::find($message_id);
        View::make('message/viewMessage.html', array('message' => $message));
    }

    public static function newMessage() {
        View::make('message/newMessage.html');
    }

    public static function store() {
        $params = $_POST;
        
        $user = new User(array('username' => $params['receiver']));

        $attributes = array(
            'receiver' => $user::findIdByUsername($user -> username),
            'title' => $params['title'],
            'content' => $params['content'],
            'sender' =>  self::get_user_logged_in( ) -> customer_id
        );
        $message = new Message($attributes);
        $errors = $message->errors();

        if (count($errors) == 0) {
            $message->save();

            Redirect::to('/viewmessage/' . $message->message_id, array('msg' => 'Message sent'));
        } else {
            View::make('message/newMessage.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

}
