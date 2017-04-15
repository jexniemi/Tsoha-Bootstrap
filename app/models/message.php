<?php

class Message extends BaseModel {

    public $message_id, $receiver, $title, $content, $time, $sender;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array(
            'validate_receiver',
            'validate_topic',
            'validate_content');
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

    public static function receiverAll($customer_id) {
        $query = DB::connection()->prepare('SELECT * FROM Message WHERE receiver = :customer_id');
        $query->execute(array('customer_id' => $customer_id));

        $rows = $query->fetchAll();
        $messages = array();

        foreach ($rows as $row) {
            $sender = new User(array(
                'customer_id' => $row['sender']
            ));

            $messages[] = new Message(array(
                'message_id' => $row['message_id'],
                'receiver' => $row['receiver'],
                'title' => $row['title'],
                'content' => $row['content'],
                'time' => $row['time'],
                'sender' => $sender->findUsernameById($sender->customer_id)
            ));
        }

        return $messages;
    }

    public static function find($message_id) {
        $query = DB::connection()->prepare('SELECT * FROM Message WHERE message_id = :message_id LIMIT 1');
        $query->execute(array('message_id' => $message_id));
        $row = $query->fetch();

        $sender = new User(array(
            'customer_id' => $row['sender']
        ));

        if ($row) {
            $message = new Message(array(
                'message_id' => $row['message_id'],
                'receiver' => $row['receiver'],
                'title' => $row['title'],
                'content' => $row['content'],
                'time' => $row['time'],
                'sender' => $sender->findUsernameById($sender->customer_id)
            ));

            return $message;
        }

        return null;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Message (receiver, title, content, sender) VALUES (:receiver, :title, :content, :sender) RETURNING message_id');

        $query->execute(array('receiver' => $this->receiver, 'title' => $this->title, 'content' => $this->content, 'sender' => $this->sender));

        $row = $query->fetch();

        Kint::trace();
        Kint::dump($row);

        $this->message_id = $row['message_id'];
    }

    public function delete() {
        $query = DB::connection()->prepare('DELETE FROM Message WHERE message_id = :message_id');
        $query->execute(array('message_id' => $this->message_id));
    }

    public function validate_receiver() {
        $user = new User(array('customer_id' => $this->receiver));
        $username = $user::findUsernameById($user->customer_id);
        return $this->validate_username($username);
    }

    public function validate_topic() {
        return $this->validate_string_minmax($this->title, 1, 20);
    }

    public function validate_content() {
        return $this->validate_string_minmax($this->title, 1, 2000);
    }

}
