<?php

class Page extends BaseModel {

    public $page_id, $title, $content, $private, $customer;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array(
            'validate_title',
            'validate_content');
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Page');
        $query->execute();

        $rows = $query->fetchAll();
        $pages = array();

        foreach ($rows as $row) {

            $pages[] = new Page(array(
                'page_id' => $row['page_id'],
                'title' => $row['title'],
                'content' => $row['content'],
                'private' => $row['private'],
                'customer' => $row['customer']
            ));
        }

        return $pages;
    }

    public static function find($page_id) {
        $query = DB::connection()->prepare('SELECT * FROM Page WHERE page_id = :page_id LIMIT 1');
        $query->execute(array('page_id' => $page_id));
        $row = $query->fetch();

        if ($row) {
            $page = new Page(array(
                'page_id' => $row['page_id'],
                'title' => $row['title'],
                'content' => $row['content'],
                'private' => $row['private'],
                'customer' => $row['customer']
            ));

            return $page;
        }

        return null;
    }

    public static function hasAccess($page_id, $customer_id) {
        $query = DB::connection()->prepare('SELECT * FROM Access WHERE page = :page_id '
                . 'AND customer = :customer_id LIMIT 1');

        $query->execute(array('page_id' => $page_id, 'customer_id' => $customer_id));
        $row = $query->fetch();
        
        if ($row) {
            return true;
        } else {
            return false;
        }
        
    }

    public static function userAll($customer_id) {
        $query = DB::connection()->prepare('SELECT * FROM Page WHERE customer = :customer');
        $query->execute(array('customer' => $customer_id));

        $rows = $query->fetchAll();
        $pages = array();

        foreach ($rows as $row) {

            $pages[] = new Page(array(
                'page_id' => $row['page_id'],
                'title' => $row['title'],
                'content' => $row['content'],
                'private' => $row['private'],
                'customer' => $row['customer']
            ));
        }

        return $pages;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Page (title, content, private, customer) VALUES (:title, :content, :private, :customer) RETURNING page_id');
        $query->execute(array(
            'title' => $this->title,
            'content' => $this->content,
            'private' => $this->private,
            'customer' => $this->customer));

        $row = $query->fetch();
        Kint::trace();
        Kint::dump($row);

        $query = DB::connection()->prepare('INSERT INTO Access (page, customer) VALUES (:page, :customer) RETURNING page');
        $query->execute(array(
            'page' => $row['page_id'],
            'customer' => $this->customer));

        $row = $query->fetch();
        Kint::trace();
        Kint::dump($row);

        $this->page_id = $row['page'];
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE Page '
                . 'SET title = :title, content = :content, private = :private '
                . 'WHERE page_id = :page_id '
                . 'RETURNING page_id');

        $query->execute(array('page_id' => $this->page_id, 'title' => $this->title, 'private' => $this->private, 'content' => $this->content));

        $row = $query->fetch();

        Kint::trace();
        Kint::dump($row);

        $this->page_id = $row['page_id'];
    }

    public function delete() {
        $query = DB::connection()->prepare('DELETE FROM Page WHERE page_id = :page_id');
        $query->execute(array('page_id

        

        ' => $this->page_id));
    }

    public function validate_title() {
        return $this->validate_string_minmax($this->title, 1, 20);
    }

    public function validate_content() {
        return $this->validate_string_minmax($this->title, 1, 2000);
    }

}
