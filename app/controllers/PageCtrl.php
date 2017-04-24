<?php

class PageCtrl extends BaseController {

    public static function pages() {
        self::check_logged_in();
        $pages = Page::userAll(self::get_user_logged_in()->customer_id);
        View::make('profile/myprofile.html', array('pages' => $pages));
    }

    public static function viewPage($page_id) {
        $page = Page::find($page_id);
        View::make('page/viewpage.html', array('page' => $page));
    }

    public static function edit($page_id) {
        $page = Page::find($page_id);
        View::make('page/editpage.html', array('attributes' => $page));
    }

    public static function update($page_id) {
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
        $page = new Page(array('page_id' => $page_id));

        $page->delete();

        Redirect::to('/myprofile', array('msg' => 'Page deleted succesfully'));
    }

    public static function newPage() {
        View::make('page/newpage.html');
    }

    public static function store() {
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
