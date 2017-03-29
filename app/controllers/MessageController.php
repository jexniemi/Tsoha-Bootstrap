<?php

class MessageController extends BaseController {

    public static function messages() {
        $messages = Message::all();
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

        $message = new Message(array(
            'receiver' => $params['receiver'],
            'title' => $params['title'],
            'content' => $params['content']
        ));
        
        Kint::dump($params);

        $message->save();
        
        Redirect::to('/viewmessage/' . $message->message_id, array('msg' => 'Message sent'));
    }

}
