<?php

class MessageController extends BaseController {

    public static function messages() {
        self::check_logged_in();
        $messages = Message::receiverAll(self::get_user_logged_in()->customer_id);

        View::make('message/messages.html', array('messages' => $messages));
    }

    public static function viewMessage($message_id) {
        self::check_logged_in();
        $message = Message::find($message_id);
        View::make('message/viewMessage.html', array('message' => $message));
    }

    public static function newMessage() {
        self::check_logged_in();
        View::make('message/newMessage.html');
    }

    public static function store() {
        self::check_logged_in();
        $params = $_POST;

        $user = new User(array('username' => $params['receiver']));

        $attributes = array(
            'receiver' => $user::findIdByUsername($user->username),
            'title' => $params['title'],
            'content' => $params['content'],
            'sender' => self::get_user_logged_in()->customer_id
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

    public static function destroy($message_id) {
        self::check_logged_in();
        $message = new Message(array('message_id' => $message_id));

        $message->delete();

        Redirect::to('/messages', array('msg' => 'Message deleted succesfully'));
    }

}
