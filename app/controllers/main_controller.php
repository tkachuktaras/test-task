<?php

class Main_Controller extends Controller
{
    function __construct()
    {
        parent::__construct();

        $this->model = new Main_Model();
        $this->survey_model = new Survey_Model();
    }

    function index()
    {
        $result = $this->survey_model->get_surveys($_SESSION['u_id']);
        $surveys = $result->fetch_all(MYSQLI_ASSOC);

        $this->view->generate('main_view.php', null, ['surveys' => $surveys]);
    }
}