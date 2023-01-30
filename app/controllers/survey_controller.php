<?php

class Survey_Controller extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new Survey_Model();
    }

    function view($id)
    {
        $result = $this->model->get_survey($id);

        if($result->num_rows > 0){
            $survey = $result->fetch_all(MYSQLI_ASSOC)[0];
            $answers = [];
            foreach(explode('¦', $survey['answers']) as $answer){
                $answer = explode('‖', $answer);
                $answers[] = [
                    'id' => $answer[0],
                    'text' => $answer[1],
                    'u_ids' => array_filter(explode('˧', $answer[2]))
                ];
            }
            $survey['answers'] = $answers;

            $this->view->generate('view_survey_view.php', null, ['survey' => $survey]);
        } else {
            Route::ErrorPage404();
        }
    }
}