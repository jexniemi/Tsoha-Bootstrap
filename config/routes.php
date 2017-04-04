<?php

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/', function() {
    HelloWorldController::front();
});

$routes->get('/browse', function() {
    HelloWorldController::browseProfiles();
});

$routes->get('/login', function() {
    HelloWorldController::login();
});

$routes->get('/myprofile', function() {
    PageCtrl::pages();
});

$routes->get('/editprofile', function() {
    HelloWorldController::editProfile();
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
    HelloWorldController::register();
});

