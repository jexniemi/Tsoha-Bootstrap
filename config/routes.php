<?php

$routes->get('/', function() {
    HelloWorldController::index();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/test', function() {
    HelloWorldController::front();
});

$routes->get('/test/browse', function() {
    HelloWorldController::browseProfiles();
});

$routes->get('/test/login', function() {
    HelloWorldController::login();
});

$routes->get('/test/myprofile', function() {
    HelloWorldController::profile();
});

$routes->get('/test/editprofile', function() {
    HelloWorldController::editProfile();
});

$routes->get('/test/messages', function() {
    HelloWorldController::messages();
});