<?php

class PageCtrl extends BaseController {

    public static function pagesUserLoggedIn() {
        self::check_logged_in();
        $pages = Page::userAll(self::get_user_logged_in()->customer_id);
        View::make('profile/myprofile.html', array('pages' => $pages));
    }

    public static function getAllByUser($customer_id) {
        self::check_logged_in();
        $pages = Page::userAll($customer_id);
        View::make('page/pages.html', array('pages' => $pages));
    }

    public static function viewPage($page_id) {
        self::check_logged_in();
        $page = Page::find($page_id);
        if ($page->private) {
            if (Page::hasAccess($page_id, self::get_user_logged_in()->customer_id)) {
                View::make('page/viewpage.html', array('page' => $page, 'users' => User::findAllWithAccess($page_id)));
            } else {
                Redirect::to('/browse', array('msg' => 'You do not have access to this page'));
            }
        } else {
            View::make('page/viewpage.html', array('page' => $page));
        }
    }

    public static function edit($page_id) {
        self::check_logged_in();
        $page = Page::find($page_id);
        View::make('page/editpage.html', array('attributes' => $page));
    }

    public static function giveAccess($page_id) {
        self::check_logged_in();
        $params = $_POST;

        $attributes = array(
            'username' => $params['username']
        );

        $customer_id = User::findIdByUsername($params['username']);
        
        if ($customer_id == null) {
            $errors[] = 'Username does not exist';
            Redirect::to('/viewpage/' . $page_id, array('errors' => $errors, 'attributes' => $attributes));
        } else {
            Page::addAccess($page_id, $customer_id);
            Redirect::to('/viewpage/' . $page_id, array('msg' => 'Access given to user ' . $params['username']));
        }
    }

    public static function update($page_id) {
        self::check_logged_in();
        $params = $_POST;

        $attributes = array(
            'page_id' => $page_id,
            'title' => $params['title'],
            'private' => $params['private'],
            'content' => $params['content']
        );

        $page = new Page($attributes);
        $errors = $page->errors();

        if (count($errors) > 0) {
            View::make('page/editpage.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $page->update();
            Redirect::to('/viewpage/' . $page->page_id, array('msg' => 'Page edited'));
        }
    }

    public static function destroy($page_id) {
        self::check_logged_in();
        $page = new Page(array('page_id' => $page_id));
        $page->delete();

        Redirect::to('/myprofile', array('msg' => 'Page deleted succesfully'));
    }

    public static function newPage() {
        self::check_logged_in();
        View::make('page/newpage.html');
    }

    public static function store() {
        self::check_logged_in();
        $params = $_POST;

        $attributes = array(
            'title' => $params['title'],
            'content' => $params['content'],
            'private' => $params['private'],
            'customer' => self::get_user_logged_in()->customer_id
        );
        $page = new Page($attributes);
        $errors = $page->errors();

        if (count($errors) == 0) {
            $page->save();

            Redirect::to('/viewpage/' . $page->page_id, array('msg' => 'Page created'));
        } else {
            View::make('page/newpage.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

}
