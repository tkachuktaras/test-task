<?php

class Controller {
    public $model;
    public $view;

    function __construct() {
        include_once "app/models/user_model.php";
        include_once "app/models/survey_model.php";

        $this->view = new View();
    }

    function index() {

    }
}