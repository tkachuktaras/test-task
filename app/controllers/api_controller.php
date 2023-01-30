<?php

class Api_Controller extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new Survey_Model();
    }

    function random_survey()
    {
        $result = $this->model->get_survey();

        if($result->num_rows > 0){
            $surveys = $result->fetch_all(MYSQLI_ASSOC);
            $rand = rand(0, count($surveys)-1);
            $survey = $surveys[$rand];
            $result_array = [
                'title' => $survey['s_title'],
                'status' => $survey['s_status'],
                'created_at' => $survey['created_at'],
            ];
            $answers = [];
            foreach(explode('¦', $survey['answers']) as $answer){
                $answer = explode('‖', $answer);
                $answers[] = [
                    'text' => $answer[1],
                    'votes' => count(array_filter(explode('˧', $answer[2])))
                ];
            }
            $result_array['answers'] = $answers;

            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($result_array);
        } else {
            Route::ErrorPage404();
        }
    }

    public function documentation() {
        $this->view->generate('documentation_view.php');
    }
}
