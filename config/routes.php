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
    HelloWorldController::profile();
});

$routes->get('/editprofile', function() {
    HelloWorldController::editProfile();
});

$routes->get('/mypage', function() {
    HelloWorldController::myPage();
});

$routes->get('/mypage_edit', function() {
    HelloWorldController::myPageEdit();
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

