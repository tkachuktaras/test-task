<?php

class Controller_404 extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $this->view->generate_404();
    }
}