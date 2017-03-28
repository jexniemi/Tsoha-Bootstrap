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
        $games = array();

        foreach ($rows as $row) {

            $message[] = new Message(array(
                'message_id' => $row['message_id'],
                'receiver' => $row['receiver'],
                'title' => $row['title'],
                'content' => $row['content'],
                'time' => $row['time'],
                'sender' => $row['sender']
            ));

            return $message;
        }
    }

    public static function find($title) {
        $query = DB::connection()->prepare('SELECT * FROM Message WHERE title = :title LIMIT 1');
        $query->execute(array('title' => $title));
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

}
