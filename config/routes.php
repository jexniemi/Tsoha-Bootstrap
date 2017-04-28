<?php

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->post('/logout', function() {
    UserCtrl::logout();
});

$routes->get('/', function() {
    HelloWorldController::front();
});

$routes->get('/browse', function() {
    UserCtrl::browseAll();
});

$routes->get('/browse/:customer_id', function($customer_id) {
    PageCtrl::getAllByUser($customer_id);
});

$routes->get('/login', function() {
    // Kirjautumislomakkeen esittäminen
    UserCtrl::login();
});
$routes->post('/login', function() {
    // Kirjautumisen käsittely
    UserCtrl::handle_login();
});

$routes->get('/myprofile', function() {
    PageCtrl::pagesUserLoggedIn();
});

$routes->get('/editprofile', function() {
    UserCtrl::editProfile();
});

$routes->post('/editprofile/:customer_id', function($customer_id) {
    UserCtrl::update($customer_id);
});

$routes->get('/newpage', function() {
    PageCtrl::newPage();
});

$routes->get('/editpage/:page_id', function($page_id) {
    PageCtrl::edit($page_id);
});

$routes->get('/viewpage/:page_id', function($page_id) {
    PageCtrl::viewPage($page_id);
});

$routes->post('/editpage/:page_id', function($page_id) {
    PageCtrl::update($page_id);
});

$routes->post('/messages/:message_id/destroy', function($message_id) {
    MessageController::destroy($message_id);
});

$routes->post('/page/:page_id/destroy', function($page_id) {
    PageCtrl::destroy($page_id);
});

$routes->post('/page', function() {
    PageCtrl::store();
});


$routes->get('/messages', function() {
    MessageController::messages();
});

$routes->post('/message', function() {
    MessageController::store();
});

$routes->get('/newmessage', function() {
    MessageController::newMessage();
});

$routes->get('/viewmessage/:message_id', function($message_id) {
    MessageController::viewMessage($message_id);
});

$routes->get('/register', function() {
    UserCtrl::register();
});

$routes->post('/register', function() {
    UserCtrl::store();
});

$routes->post('/myprofile/:customer_id/destroy', function($customer_id) {
    UserCtrl::destroy($customer_id);
});
