<?php

class Message extends BaseModel {

    public $message_id, $receiver, $title, $content, $time, $sender;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Message');
        $query->execute();

        $rows = $query->fetchAll();
        $messages = array();

        foreach ($rows as $row) {

            $messages[] = new Message(array(
                'message_id' => $row['message_id'],
                'receiver' => $row['receiver'],
                'title' => $row['title'],
                'content' => $row['content'],
                'time' => $row['time'],
                'sender' => $row['sender']
            ));
        }
        
        return $messages;
    }

    public static function find($message_id) {
        $query = DB::connection()->prepare('SELECT * FROM Message WHERE message_id = :message_id LIMIT 1');
        $query->execute(array('message_id' => $message_id));
        $row = $query->fetch();

        if ($row) {
            $message = new Message(array(
                'message_id' => $row['message_id'],
                'receiver' => $row['receiver'],
                'title' => $row['title'],
                'content' => $row['content'],
                'time' => $row['time'],
                'sender' => $row['sender']
            ));

            return $message;
        }

        return null;
    }
    
    public function save(){
        $query = DB::connection() -> prepare('INSERT INTO Message (receiver, title, content) VALUES (:receiver, :title, :content) RETURNING message_id');
        
        $query -> execute(array('receiver' => $this->receiver, 'title' => $this->title, 'content' => $this->content));
        
        $row = $query->fetch();
        
        Kint::trace();
        Kint::dump($row);
        
        $this->message_id = $row['message_id'];
    }

}
