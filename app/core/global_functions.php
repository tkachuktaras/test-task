<?php

function dd($parameter){
    var_dump(func_get_args());
    die;
}

function current_url(){
    return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}

function url($url = null){
    return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $url ?? '';
}

function get_salt(){
    return "1FAt8Z6yX1";
}

function get_auth_status(){
    include_once "app/controllers/login_controller.php";
    return (new Login_Controller())->check_auth();
}